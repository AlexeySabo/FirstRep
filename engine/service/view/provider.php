<?php

namespace engine\service\view;

use engine\service\abstractprovider;
use engine\core\template\view;

class provider extends abstractprovider
{
    /**
     * @var string
     */
    public $serviceName = 'view';
    /**
     * @return mixed|void
     */
    public function init()
    {
        $view = new view();

        $this->di->set($this->serviceName, $view);
    }
}