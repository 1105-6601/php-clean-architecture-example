<?php

namespace App\Interfaces\Gateway\Database;

interface HandlerInterface
{
    public function findById(string $entityClass, int $id): \ArrayObject;
}
