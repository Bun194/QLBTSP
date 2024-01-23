<?php
    namespace App\core;
    
    class Route {
        protected array $routes;

        public function register(string $route, callable|array $action): self {
            //var_dump($aroute);
            // echo "Hiện thị register";
            $this->routes[$route] = $action;
            //var_dump($this->routes);
            return $this;
        }
        

        public function resolve(string $requestUrl){
            $route = explode('?', $requestUrl)[0];
            $action = $this->routes[$route] ?? null;
            if(!$action){
                // throw new RouteNotFoundException();
                echo "Không có gì cả";
            }

            if(is_callable($action)){
                return call_user_func($action);
            }

            if(is_array( $action )){
                [$class, $method] = $action;

                if(class_exists($class)){
                    $class = new $class();

                    if(method_exists($class, $method)){
                        return call_user_func_array( [$class, $method], []);
                    }
                }
            }
        }
    }

?>