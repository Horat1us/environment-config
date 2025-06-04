<?php

namespace Horat1us\Environment;

/**
 * Class MissingEnvironmentException
 * @package Horat1us\Environment
 * @deprecated
 */
class MissingEnvironmentException extends \RuntimeException implements Exception
{
    /** @var string */
    protected $key;

    public function __construct(string $key, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("Missing environment key {$key}", $code, $previous);
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
