<?php

namespace App\Interfaces\Gateway\Repository;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserFirstName;
use App\Domain\Entity\User\UserId;
use App\Domain\Entity\User\UserLastName;
use App\Domain\Exception\EntityNotFoundException;
use App\Usecase\Repository\UserRepositoryInterface;
use App\Interfaces\Gateway\Database\HandlerInterface;

class UserRepository implements UserRepositoryInterface
{
    /** @var HandlerInterface */
    private $Handler;

    /**
     * UserRepository constructor.
     * @param HandlerInterface $handler
     */
    public function __construct(HandlerInterface $handler)
    {
        $this->Handler = $handler;
    }

    /**
     * @param int $id
     * @return User
     */
    public function one(int $id): User
    {
        $user = $this->Handler->findById(User::class, $id);

        if (!isset($user['id'])) {
            throw new EntityNotFoundException();
        }

        return new User(
            new UserId        ($user['id']),
            new UserFirstName ($user['first_name']),
            new UserLastName  ($user['last_name'])
        );
    }
}
