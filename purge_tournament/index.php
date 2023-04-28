<?php

session_start();

require 'autoload.php';

/**
 * @author : Gaellan
 */

try {

    $router = new Router();
    $router->checkRoute();
}

catch(Exception $e)
{
    if($e->getCode() === 404)
    {
        require "./templates/404.phtml";
    }
}