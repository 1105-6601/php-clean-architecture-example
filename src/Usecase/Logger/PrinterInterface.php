<?php

namespace App\Usecase\Logger;

interface PrinterInterface
{
    public function error    (string $text):                    void;
    public function errorF   (string $format, string ...$args): void;
    public function success  (string $text):                    void;
    public function successF (string $format, string ...$args): void;
}
