<?php

namespace engine;

use engine\core\router\dispatchedroute;
use engine\helper\common;

class cms
{
    /**
     * @var
     */
    private $di;

    public $router;

    /**
     * cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     *
     */
    public function run()
    {
        try {

            require_once __DIR__.'/../cms/route.php';

            $routerDispatch = $this->router->dispatch(common::getMethod(), common::getPathUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new dispatchedroute('errorcontroller:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\cms\\controller\\' . $class;

            $parameters = $routerDispatch->getParameters();



            call_user_func_array([new $controller($this->di), $action], $parameters);

        }catch(\Exception $e)
        {
            echo $e->getMessage();
            exit;
        }

    }

}