<?php

namespace App\Infrastructure\Logger;

use Colors\Color;
use App\Usecase\Logger\PrinterInterface;

class ColorPrinter implements PrinterInterface
{
    /** @var bool */
    private $isCli = false;

    /**
     * ColorPrinter constructor.
     */
    public function __construct()
    {
        $this->isCli = php_sapi_name() == 'cli';
    }

    /**
     * @param string $text
     */
    public function error(string $text): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())($text.PHP_EOL)->red;
    }

    /**
     * @param string $format
     * @param string[] ...$args
     */
    public function errorF(string $format, string ...$args): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())(sprintf($format, ...$args).PHP_EOL)->red;
    }

    /**
     * @param string $text
     */
    public function success(string $text): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())($text.PHP_EOL)->green;
    }

    /**
     * @param string $format
     * @param string[] ...$args
     */
    public function successF(string $format, string ...$args): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())(sprintf($format, ...$args).PHP_EOL)->green;
    }


    /**
     * @param string $text
     */
    public function info(string $text): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())($text.PHP_EOL)->blue;
    }

    /**
     * @param string $format
     * @param string[] ...$args
     */
    public function infoF(string $format, string ...$args): void
    {
        if (!$this->isCli) {
            return;
        }

        echo (new Color())(sprintf($format, ...$args).PHP_EOL)->blue;
    }
}
