<?php

namespace App\core;

class Route
{
    private array $routes;

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        //var_dump($aroute);
        // echo "Hiện thị register";
        $this->routes[$requestMethod][$route] = $action;
        //var_dump($this->routes);
        return $this;
    }


    public function resolve(string $requesUrl, string $requestMethod)
    {
        $route = explode('?', $requesUrl)[0];
        // $action = $this->routes[$route] ?? null;
        $action = $this->routes[$requestMethod][$route] ?? null;
        if (!$action) {
            // throw new RouteNoFoundException();
            echo 'Không tìm thấy';
        }
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $class = new $class();
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
    }
    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }
    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    // public function get (string $route, callable | array $action ): self {
    //     return $this->register('get', $route, $action);
    // }

    // public function post (string $route, callable | array $action ): self {
    //     return $this->register('post', $route, $action);
    // }

    // public function resolve (string $requestUrl, string $requestMethod) {
    //     $route = explode ('?', $requestUrl[0]);
    //     //var_dump($route);
    //     //var_dump($requestUrl[0]);
    //     //$action = $this->routes[$route] ?? null;
    //     $action = $this->routes[$requestMethod][$route] ?? null;
    //     //var_dump($action);

    // }
}
