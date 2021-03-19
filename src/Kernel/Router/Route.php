<?php

namespace App\Kernel\Router;

use App\Dev\VarDumper;

class Route{

    private $path;
    private $callable;
    private $matches    = [];
    private $params = [];

    public function __construct($path, $callable)
    {
        $this->path     = trim($path, "/");
        $this->callable = $callable;
    }

    public function matches(string $url):bool
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'matchesWith'], $this->path);
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches))
            return false;
        
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function go()
    {
        if(!is_string($this->callable))
            return call_user_func_array($this->callable, $this->matches);
        
        $action = explode('#', $this->callable);
        $controller = "App\\Controller\\".ucfirst($action[0])."Controller";
        $controller = new $controller();
        return call_user_func_array([$controller, $action[1]], $this->matches);
    }

    public function with(string $param, string $pattern):self
    {
        $this->params[$param] = str_replace('(', '(?:', $pattern);
        return $this;
    }

    public function matchesWith($match)
    {
        if(isset($this->params[$match[1]]))
            return '('. $this->params[$match[1]]. ')';

        return '([^/]+)';
    }

    public function getUrlWith(array $params)
    {
        $path = $this->path;

        foreach($this->params as $k=>$v)
        {
            $path = str_replace(":$k", $v, $path);
        }
        return $path; 
    }
}