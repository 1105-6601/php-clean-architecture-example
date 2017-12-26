<?php

namespace App\Infrastructure\Ui\Context;

use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Controller\Context\HttpContextInterface;

class HttpContext implements HttpContextInterface
{
    /** @var Response */
    private $response;

    /** @var \ArrayObject */
    private $args;

    /**
     * HttpContext constructor.
     * @param Response $response
     * @param array $args
     */
    public function __construct(
        Response $response,
        array $args = []
    ) {
        $this->response = $response;
        $this->args     = new \ArrayObject($args);
    }

    /**
     * @return \ArrayObject
     */
    public function args(): \ArrayObject
    {
        return $this->args;
    }

    /**
     * @param string $body
     * @param int $responseCode
     */
    public function json(string $body, int $responseCode = 200): void
    {
        $this->response->setStatusCode($responseCode);
        $this->response->setContent(json_encode($body));
        $this->response->headers->set('Content-Type', 'application/json; charset=utf-8');
    }
}
