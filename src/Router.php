<?php
namespace Core;

use Exception;

class Router 
{
    public $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $mappedRoute = $this->lookupRoute($method, $uri);
        
        $controllerName = null;
        $methodName = null;
        $params = array();

        $mappedRoute = explode("@", $mappedRoute);
        $controllerName = $mappedRoute[0];
        $methodName = $mappedRoute[1];
        $params = $this->getParams($uri);

        $this->route($controllerName, $methodName, $params);
    }

    private function route(string $controllerName, string $methodName, array $params)
    {
        $class = "\App\Controller\\".$controllerName;
        if(class_exists($class))
        {
            $controllerObject = new $class();

            if(method_exists($controllerObject, $methodName))
            {
                if(is_callable(array($controllerObject, $methodName)))
                {
                    $controllerObject->$methodName($params);
                }
                else
                {
                    throw new Exception("Method not callable");
                }
            }
            else
            {
                throw new Exception("Method does not exist");
            }
        }
        else
        {
            throw new Exception("Controller does not exist");
        }
    }

    private function getParams(string $uri)
    {
        $params = array();
        $values = explode("/", $uri);
        
        if(count($values) > 2)
        {
            for($i = 3; $i < count($values); $i++)
            {
                $params[] = $values[$i];
            }
        }

        return $params;
    }

    private function lookupRoute(string $httpMethod, string $uri)
    {
        $uri = explode("/", $uri);
        
        if(isset($uri[1]) && !isset($uri[2]))
        {
            $path = "/".$uri[1];
        }

        if(isset($uri[1]) && isset($uri[2]))
        {
            $path = "/".$uri[1]."/".$uri[2];
        }

        if(isset($this->routes[$httpMethod][$path]))
        {
            $mappedRoute = $this->routes[$httpMethod][$path];  
        }
        else
        {
            $mappedRoute = "Index@default";
        }

        return $mappedRoute;
    }
}