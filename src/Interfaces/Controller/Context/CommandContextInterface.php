<?php

namespace App\Interfaces\Controller\Context;

interface CommandContextInterface
{
    public function args(): \ArrayObject;
    public function echo(string $body);
}
