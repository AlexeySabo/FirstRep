<?php

namespace engine\service\router;

use engine\service\abstractprovider;
use engine\core\router\router;

class provider extends abstractprovider
{
    /**
     * @var string
     */
    public $serviceName = 'router';
    /**
     * @return mixed|void
     */
    public function init()
    {
        $router = new router('http://cms.loc/');

        $this->di->set($this->serviceName, $router);
    }
}