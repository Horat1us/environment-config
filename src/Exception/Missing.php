<?php

namespace Horat1us\Environment\Exception;

use Horat1us\Environment;

/**
 * Class Missing
 * @package Horat1us\Environment\Exception
 */
class Missing extends \RuntimeException implements Environment\Exception
{
    /** @var string */
    protected $key;

    public function __construct(string $key, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("Missing environment key {$key}", $code, $previous);
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
