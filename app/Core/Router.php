<?php
// app/Core/Router.php

namespace App\Core;

class Router {
    protected $routes = [];

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$this->normalizeUri($uri)] = $controllerAction;
    }

    public function post($uri, $controllerAction) {
        $this->routes['POST'][$this->normalizeUri($uri)] = $controllerAction;
    }

    public function normalizeUri($uri) {
        $uri = parse_url($uri, PHP_URL_PATH) ?? '/';
        $prefix = '/stajyer-basvuru-sistemi/public';
        if (strpos($uri, $prefix) === 0) {
            $uri = substr($uri, strlen($prefix));
        }
        if (empty($uri)) {
            $uri = '/';
        }
        if (strlen($uri) > 1) {
            $uri = rtrim($uri, '/');
        }
        return $uri;
    }

    public function dispatch($uri, $requestMethod) {
        $path = $this->normalizeUri($uri);

        if (isset($this->routes[$requestMethod]) && array_key_exists($path, $this->routes[$requestMethod])) {
            $action = $this->routes[$requestMethod][$path];
            
            if (is_callable($action)) {
                call_user_func($action);
                return;
            }
            
            $controllerName = $action[0];
            $methodName = $action[1];

            $controller = new $controllerName();
            $controller->$methodName();

        } else {
            http_response_code(404);
            echo "404 - Sayfa Bulunamadı (" . htmlspecialchars($path) . ")";
        }
    }
}