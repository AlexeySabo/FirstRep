<?php

namespace engine\core\router;

class urldispatcher
{
    private $methods = [
        'GET',
        'POST'
    ];
    /**
     * @var array
     */
    private $routes = [
        'GET' => [],
        'POST' => []
    ];
    /**
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * @param $key
     * @param $pattern
     */
    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    private function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    public function register($method, $pattern, $controller)
    {
        //print_r($pattern);
        //echo '<br>';
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    private function convertPattern($pattern)
    {
        if(strpos($pattern,'(') === false)
        {
            return $pattern;
        }

        return preg_replace_callback('#\((\w+):(\w+)\)#',[$this, 'replacePattern'], $pattern);
    }

    protected function replacePattern($matches)
    {
        //print_r($matches);

        return '(?<'.$matches[1].'>'.strtr($matches[2],$this->patterns).')';
    }

    private function processParam($parameters)
    {
        foreach ($parameters as $key => $value)
        {
            if(is_int($key))
            {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }

    public function dispatch($method,$uri)
    {
        $routes = $this->routes(strtoupper($method));

        if(array_key_exists($uri,$routes))
        {
            return new dispatchedroute($routes[$uri]);
        }

        return $this->doDispatch($method,$uri);
    }

    private function doDispatch($method, $uri)
    {
        foreach($this->routes(($method)) as $route => $controller)
        {
            $pattern = '#^'.$route.'$#s';

            if(preg_match($pattern,$uri,$parameters))
            {
                return new dispatchedroute($controller, $this->processParam($parameters));
            }
        }
    }
}