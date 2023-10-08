<?php

namespace App;

use App\Attributes\Route;
use App\Exceptions\RouteNotFoundException;
use Illuminate\Container\Container;

class Router
{
    private array $routes = [];

    public function __construct(protected Container $container)
    {
    }

    public function register(string $methodName, string $route, callable|array $action):self
    {
        $this->routes[$methodName][$route]= $action;
        return $this;
    }

    public function get(string $route,callable|array $action):self
    {
        $this->register('get', $route, $action);
        return $this;
    }

    public function registerRoutesFromControllersAttributes(array $controllers)
    {
        foreach($controllers as $controller)
        {
            //Create the reflection class
            $reflectionController = new \ReflectionClass($controller);

            //Get the methods
            foreach($reflectionController->getMethods() as $method){
                //Get the attributes
                $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute)
                {
                    //Create the instance or object of the attribute Route class
                    $route = $attribute->newInstance();
                    $this->register($route->method->value, $route->routePath, [$controller, $method->getName()]);
                }
            }
            //Call the register method
        }
    }

    public function post(string $route,callable|array $action):self
    {
        $this->register('post', $route, $action);
        return $this;
    }

    public function resolve(string $requestURI, string $methodName)
    {
        $route = explode('?', $requestURI)[0];
        $action = $this->routes[$methodName][$route] ?? null;

        if($action === null){
            throw new RouteNotFoundException();
        }

        if(is_callable($action))
        {
            return call_user_func_array($action, []);
        }

        if(is_array($action)){
            [$class, $method] = $action;
            if(class_exists($class)){
//                $class = new $class();
                $class = $this->container->get($class);
                if(method_exists($class, $method)){
                    //call_user_func_array([$class, $method], []);
                    return $class->$method();
                }
            }
        }

        throw new RouteNotFoundException();

    }

    /**
    * @return array
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }

}