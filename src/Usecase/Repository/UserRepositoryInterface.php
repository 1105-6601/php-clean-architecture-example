<?php

namespace App\Usecase\Repository;

use App\Domain\Entity\User\User;

interface UserRepositoryInterface
{
    public function one(int $id): User;
}
