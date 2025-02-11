<?php
namespace App\System\Routing;

use App\System\Routing\Exceptions\InvalidRouteHandler;
use App\System\Routing\Exceptions\RouteNotFound;

class Router
{
    private array $routes = [];
    
    /**
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->registerRoutesFromControllers();
    }
    
    public function add(string $path, callable|array $callback): void
    {
        $this->routes[trim($path, '/')] = $callback;
    }
    
    public function run(): void
    {   
        try {
            $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            $routingParams = $this->defineRoutingParameters($requestUri);
            $this->callRouteHandler($routingParams);
        } catch (RouteNotFound) {
            http_response_code(404);
            echo "404 Not Found";
        } catch (InvalidRouteHandler) {
            echo "Invalid route handler.";
            
        }
    }
    
    /**
     * @todo: capture Reflection Exception and log them.
     * @return void
     * @throws \ReflectionException
     */
    private function registerRoutesFromControllers(): void
    {
        $controllers = glob(__DIR__ . '/../../Controllers/*.php');
        
        // @todo: add caching
        foreach ($controllers as $controllerFile) {
            $className = 'App\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
            $reflectionController = new \ReflectionClass($className);
            
            foreach ($reflectionController->getMethods() as $method) {
                if ($method->isPublic() && !$method->isConstructor() && !$method->isDestructor()) {
                    $attributes = $method->getAttributes(Route::class);
                    
                    foreach ($attributes as $attribute) {
                        /** @var Route $route */
                        $route = $attribute->newInstance();
                        
                        $this->add($route->routePath, [$className, $method->getName()]);
                    }
                }
            }
        }
    }
    
    private function defineRoutingParameters(string $requestUri): RoutingParamsInterface
    {
        $routingParams = $this->createRoutingParameters();
        
        // Direct match
        if (isset($this->routes[$requestUri])) {
            $routingParams = $this->createRoutingParameters(
                $this->routes[$requestUri],
                []
            );
        } else {
        // Match by pattern
            foreach ($this->routes as $routePath => $handler) {
                $pattern = preg_replace('#\{\w+\}#', '([^\/]+)', $routePath);
                
                if (preg_match("#^$pattern$#", $requestUri, $arguments)) {
                    array_shift($arguments);
                    
                    $routingParams = $this->createRoutingParameters(
                        $handler,
                        $arguments
                    );
                }
            }
        }
        
        return $routingParams;
    }
    
    /**
     * @throws RouteNotFound
     * @throws InvalidRouteHandler
     */
    private function callRouteHandler(RoutingParamsInterface $routingParams): void
    {
        $callback = $routingParams->getCallback();
        
        if (!empty($callback)) {
            // Controller action
            if (is_array($callback) && class_exists($callback[0]) && method_exists($callback[0], $callback[1])) {
                $controller = new $callback[0]();
                call_user_func_array([$controller, $callback[1]], $routingParams->getArguments());
                return;
            }
            
            // Closure or valid callable function
            if (is_callable($callback)) {
                call_user_func($callback, $routingParams->getArguments());
                return;
            }
            
            throw new InvalidRouteHandler;
        }
        
        throw new RouteNotFound();
    }
    
    /**
     * @todo: Extract to the RoutingFactory
     * @todo: Make Router class depend on RoutingFactory
     */
    private function createRoutingParameters(mixed $callback = null, mixed $arguments = []): RoutingParamsInterface
    {
        return new RoutingParams(
            $callback,
            $arguments
        );
    }
}



