<?php

namespace App\Infrastructure\Config;

class Loader
{
    /** @var string */
    private $env;

    /**
     * Loader constructor.
     * @param string $env
     */
    public function __construct(string $env = '')
    {
        $this->env = $env;
    }

    /**
     * Loading config and define constants.
     */
    public function load(): void
    {
        $envFile = '.env';
        if ($this->env !== '') {
            $envFile = sprintf("$envFile.%s", $this->env);
        }

        $envPath = dirname(dirname(dirname(dirname(__FILE__)))).'/'.$envFile;

        (new \josegonzalez\Dotenv\Loader($envPath))->parse()->define();
    }
}
