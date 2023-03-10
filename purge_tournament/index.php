<?php

session_start();

require 'autoload.php';

$router = new Router();

$router->checkRoute();