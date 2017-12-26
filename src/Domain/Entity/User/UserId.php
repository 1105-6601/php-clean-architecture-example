<?php

namespace App\Domain\Entity\User;

use App\Domain\Exception\ArgumentOutOfRangeException;

class UserId
{
    /** @var int */
    private $value;

    /**
     * UserId constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new ArgumentOutOfRangeException(sprintf('Users ID must be greater than equal 0. Provided value is %d', $value));
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
