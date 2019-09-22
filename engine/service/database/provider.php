<?php

namespace engine\service\database;

use engine\service\abstractprovider;
use engine\core\database\connection;

class provider extends abstractprovider
{
    /**
     * @var string
     */
    public $serviceName = 'db';
    /**
     * @return mixed|void
     */
    public function init()
    {
        $db = new connection();

        $this->di->set($this->serviceName, $db);
    }
}