<?php

namespace App\Infrastructure\Ui\Context;

use App\Infrastructure\Logger\ColorPrinter;
use App\Interfaces\Controller\Context\CommandContextInterface;

class CommandContext implements CommandContextInterface
{
    /** @var \ArrayObject */
    private $args;

    /** @var ColorPrinter */
    private $printer = null;

    /**
     * HttpContext constructor.
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->args = new \ArrayObject($args);
    }

    /**
     * @return \ArrayObject
     */
    public function args(): \ArrayObject
    {
        return $this->args;
    }

    /**
     * @param ColorPrinter $printer
     */
    public function setPrinter(ColorPrinter $printer): void
    {
        $this->printer = $printer;
    }

    public function echo(string $body)
    {
        if ($this->printer) {
            $this->printer->info($body);
        } else {
            echo "$body\n";
        }
    }
}
