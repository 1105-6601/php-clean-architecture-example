<?php

namespace App\Interfaces\Controller\Context;

interface HttpContextInterface
{
    public function args(): \ArrayObject;
    public function json(string $body, int $responseCode = 200);
}
