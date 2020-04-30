<?php

require 'Engine/Loader.php';

use App\Engine\Loader;
use App\Engine\Auth;
use App\Engine\Router;

define('ROOT', __DIR__.'/');

Loader::run();
Auth::run();
Router::getInstance()->run();