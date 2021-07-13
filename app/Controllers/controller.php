<?php

namespace App\Controllers;

class controller
{

    protected $container;

    function __construct($container = NULL)
    {
        $this->container = $container;
    }

    function __get($key)
    {
        if (isset($this->container->{$key})) {
            return $this->container->{$key};
        }
    }
}
