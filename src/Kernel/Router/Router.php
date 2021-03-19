<?php

namespace App\Kernel\Router;

use App\Dev\VarDumper;

class Router{

    private $url;
    private $routes = [];
    private $namedRoutes    = [];
    
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function get(string $path, $callable, $name=null)
    {
        return $this->addRoute($path, $callable, 'GET', $name);
    }

    public function post(string $path, $callable, $name=null)
    {
        return $this->addRoute($path, $callable, 'POST', $name);
    }

    private function addRoute(string $path, $callable, string $method, ?string $name)
    {
        $route  =new Route($path, $callable);
        $this->routes[$method][]  = $route;
        if(is_string($callable) && !$name)
            $name = $callable;

        if($name)
        {
            $this->namedRoutes[$name]   = $route;
        }
        return $route;
    }
    
    public function routing()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
            throw new RouterException("REQUEST_METHOD  is not supported: ".$_SERVER['REQUEST_METHOD']);
        
        if(isset($this->namedRoutes[$this->url]))
            return $this->namedRoutes[$this->url]->go();                
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->matches($this->url))
                return $route->go();
        }

        throw new RouterException("No route matches with $this->url");
    }

    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrlWith($params);
    }
}