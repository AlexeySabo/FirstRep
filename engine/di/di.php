<?php

namespace engine\di;

class di
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function get($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]) ? $this->container[$key] : null;
    }
}