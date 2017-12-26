<?php

namespace App\Domain\Entity\User;

use App\Domain\Exception\ArgumentOutOfRangeException;

class UserLastName
{
    /** @var string */
    private $value;

    /**
     * UserLastName constructor.
     * @param string $value
     */
    public function __construct(string $value = '')
    {
        if (mb_strlen($value) > 255) {
            throw new ArgumentOutOfRangeException(sprintf('Users last name length must be less than 255. Provided length is %d', mb_strlen($value)));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
