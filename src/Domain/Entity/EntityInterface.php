<?php

namespace App\Domain\Entity;

interface EntityInterface
{
    /**
     * @return string
     */
    public static function table(): string;

    /**
     * @return array<string>
     */
    public static function fillable(): array;
}
