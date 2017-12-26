<?php

namespace App\Domain\Entity\User;

use App\Domain\Entity\Entity;

class User extends Entity
{
    public static function table(): string
    {
        return 'users';
    }

    public static function fillable(): array
    {
        return [
            'first_name',
            'last_name'
        ];
    }

    /** @var UserId */
    private $id;

    /** @var UserFirstName */
    private $first_name;

    /** @var UserLastName */
    private $last_name;

    /**
     * User constructor.
     * @param UserId $id
     * @param UserFirstName $firstName
     * @param UserLastName $lastName
     */
    public function __construct(
        UserId        $id,
        UserFirstName $firstName,
        UserLastName  $lastName
    ) {
        $this->id         = $id;
        $this->first_name = $firstName;
        $this->last_name  = $lastName;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return sprintf('%s %s', $this->first_name->value(), $this->last_name->value());
    }
}
