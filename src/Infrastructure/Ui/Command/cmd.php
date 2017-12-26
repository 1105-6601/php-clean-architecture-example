<?php

ini_set( 'display_errors', 1 );
error_reporting(E_ALL);

require_once '../../../../vendor/autoload.php';

use App\Infrastructure\Config\Loader;
use App\Infrastructure\Logger\ColorPrinter;
use App\Interfaces\Controller\GreetingController;
use App\Infrastructure\Database\MysqlHandler;
use App\Infrastructure\Ui\Context\CommandContext;

(new Loader())->load();

$cmd  = $argv[1] ?? null;
$args = array_slice($argv, 2);

switch ($cmd) {

    case '-say-hello':
        $printer = new ColorPrinter();

        $context = new CommandContext($args);
        $context->setPrinter($printer);

        (new GreetingController(new MysqlHandler(), $printer))->cmdSayHello($context);

        break;

    default:
        echo "Specified command is not defined.\n";
}
