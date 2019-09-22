<?php

namespace engine\core\router;


class dispatchedroute
{
    private $controller;
    private $parameters;

    /**
     * dispatchedroute constructor.
     * @param $controller
     * @param array $parameters
     */
    public function __construct($controller,$parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

}