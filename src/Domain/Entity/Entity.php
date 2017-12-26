<?php

namespace App\Domain\Entity;

abstract class Entity
{
    /**
     * @return string
     */
    abstract public static function table(): string;

    /**
     * @return array<string>
     */
    abstract public static function fillable(): array;
}
