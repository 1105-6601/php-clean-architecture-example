<?php

namespace App\Infrastructure\Router;

use App\Infrastructure\Logger\ColorPrinter;
use App\Infrastructure\Ui\Context\HttpContext;
use App\Interfaces\Controller\GreetingController;
use App\Interfaces\Gateway\Database\HandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class Engine
{
    /** @var  Dispatcher */
    private $Dispatcher;

    /**
     * Engine constructor.
     * @param HandlerInterface $handler
     */
    public function __construct(HandlerInterface $handler)
    {
        $this->Dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $r) use ($handler) {

            $r->addGroup('/v1', function(RouteCollector $r) use ($handler) {

                $greetingController = new GreetingController($handler, new ColorPrinter());

                $r->addRoute('GET', '/hello/{id:\d+}', [$greetingController, 'restSayHello']);
            });
        });
    }

    /**
     * Run Engine.
     */
    public function run(): void
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri        = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $this->Dispatcher->dispatch($httpMethod, $uri);
        $response = new Response();

        switch ($routeInfo[0]) {

            case Dispatcher::NOT_FOUND:
                $response->setStatusCode(Response::HTTP_NOT_FOUND);
                $response->setContent('Not found.');
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                $response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
                break;

            case Dispatcher::FOUND:
                $response->setStatusCode(Response::HTTP_OK);

                $handler = $routeInfo[1];
                $args    = $routeInfo[2];

                $handler(new HttpContext($response, $args));
                break;
        }

        $response->sendHeaders();
        $response->sendContent();
    }
}
