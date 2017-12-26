<?php

namespace App\Interfaces\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\Controller\Context\CommandContextInterface;
use App\Interfaces\Controller\Context\HttpContextInterface;
use App\Interfaces\Gateway\Database\HandlerInterface;
use App\Interfaces\Gateway\Repository\UserRepository;
use App\Usecase\Logger\PrinterInterface;
use App\Usecase\GreetingInteractor;


class GreetingController
{
    /** @var GreetingInteractor */
    private $GreetingInteractor;

    /**
     * GreetingController constructor.
     * @param HandlerInterface $handler
     * @param PrinterInterface $printer
     */
    public function __construct(
        HandlerInterface $handler,
        PrinterInterface $printer
    ) {
        $this->GreetingInteractor = new GreetingInteractor(new UserRepository($handler), $printer);
    }

    /**
     * @param HttpContextInterface $context
     */
    public function restSayHello(HttpContextInterface $context): void
    {
        $args = $context->args();

        try {
            $content = $this->GreetingInteractor->makePhrase($args['id']);
        } catch (\Exception $e) {
            $context->json('Failed to find user.', Response::HTTP_NOT_FOUND);
            return;
        }

        $context->json($content);
    }

    /**
     * @param CommandContextInterface $context
     */
    public function cmdSayHello(CommandContextInterface $context): void
    {
        $args = $context->args();

        $id = $args[0] ?? null;

        if ($id === null) {
            $context->echo('ID was not specified.');
            return;
        }

        try {
            $content = $this->GreetingInteractor->makePhrase($id);
        } catch (\Exception $e) {
            $context->echo('Failed to find user.');
            return;
        }

        $context->echo($content);
    }
}
