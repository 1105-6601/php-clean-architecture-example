<?php

namespace App\Usecase;

use App\Domain\Exception\EntityNotFoundException;
use App\Usecase\Repository\UserRepositoryInterface;
use App\Usecase\Logger\PrinterInterface;

class GreetingInteractor
{
    /** @var UserRepositoryInterface */
    private $UserRepository;

    /** @var PrinterInterface */
    private $Printer;

    /**
     * GreetingInteractor constructor.
     * @param UserRepositoryInterface $userRepository
     * @param PrinterInterface $printer
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        PrinterInterface $printer
    ) {
        $this->UserRepository = $userRepository;
        $this->Printer        = $printer;
    }

    /**
     * @param int $userId
     * @return string
     */
    public function makePhrase(int $userId): string
    {
        try {
            $user = $this->UserRepository->one($userId);
            $this->Printer->success('Specified User was found.');
        } catch (EntityNotFoundException $e) {
            $this->Printer->error('Failed to find user.');
            throw $e;
        }

        return sprintf('Hello %s!', $user->fullName());
    }
}
