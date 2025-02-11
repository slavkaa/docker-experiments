<?php
namespace App\System;

class Router
{
    private array $routes = [];
    
    public function add(string $path, callable|array $callback): void
    {
        $this->routes[trim($path, '/')] = $callback;
    }
    
    public function run(): void
    {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        
        if (isset($this->routes[$requestUri])) {
            $callback = $this->routes[$requestUri];
            
            // Controller action=
            if (is_array($callback) && class_exists($callback[0]) && method_exists($callback[0], $callback[1])) {
                $controller = new $callback[0](); // ✅ Create instance
                call_user_func([$controller, $callback[1]]);
                return;
            }
            
            // Closure or valid callable function
            if (is_callable($callback)) {
                call_user_func($callback);
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
