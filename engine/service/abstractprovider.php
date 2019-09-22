<?php

namespace engine\service;

abstract class abstractprovider
{
    /**
     * @var
     */
    protected $di;

    /**
     * abstractprovider constructor.
     * @param \engine\di\di $di
     */
    public function __construct(\engine\di\di $di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    abstract function init();
}