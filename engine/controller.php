<?php

namespace engine;

use engine\di\di;

abstract class controller
{
    /**
     * @var
     */
    protected $di;

    protected $db;

    protected $view;


    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->view = $this->di->get('view');
    }

}