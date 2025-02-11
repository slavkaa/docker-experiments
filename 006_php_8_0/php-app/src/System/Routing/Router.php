<?php
namespace App\System\Routing;

use \App\Controllers\AttributesDemoController as AttributesDemoController;

class Router
{
    private array $routes = [];
    
    public function __construct()
    {
        
    }
    
    public function add(string $path, callable|array $callback): void
    {
        $this->routes[trim($path, '/')] = $callback;
    }
    
    /**
     * @return void
     * @throws \ReflectionException
     */
    public function registerRoutesFromControllers(): void
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
    
    public function run(): void
    {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        
        $callback = null;
        $arguments = [];
        
        if (isset($this->routes[$requestUri])) {
            $callback = $this->routes[$requestUri];
        } else {
            foreach ($this->routes as $route => $handler) {
                $pattern = preg_replace('#\{\w+\}#', '([^\/]+)', $route);
                
                if (preg_match("#^$pattern$#", $requestUri, $arguments)) {
                    array_shift($arguments);
                    $callback = $handler;
                }
            }
        }
        
        if (!empty($callback)) {
            // Controller action
            if (is_array($callback) && class_exists($callback[0]) && method_exists($callback[0], $callback[1])) {
                $controller = new $callback[0]();
                call_user_func_array([$controller, $callback[1]], $arguments);
                return;
            }
            
            // Closure or valid callable function
            if (is_callable($callback)) {
                call_user_func_array($callback, $arguments);
                return;
            }
            
            http_response_code(500);
            echo "Invalid route handler.";
            return;
        }
        
        http_response_code(404);
        echo "404 Not Found";
    }
}



