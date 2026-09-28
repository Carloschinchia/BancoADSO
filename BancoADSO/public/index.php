<?php

session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Nucleo\Router;

(new Router())->despachar();
