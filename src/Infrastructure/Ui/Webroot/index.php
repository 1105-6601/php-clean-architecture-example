<?php

ini_set( 'display_errors', 1 );
error_reporting(E_ALL);

require_once '../../../../vendor/autoload.php';

use App\Infrastructure\Database\MysqlHandler;
use App\Infrastructure\Config\Loader;
use App\Infrastructure\Router\Engine;

(new Loader())->load();
(new Engine(new MysqlHandler()))->run();
