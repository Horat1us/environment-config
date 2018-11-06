<?php

namespace Horat1us\Environment\Exception;

use Horat1us\Environment;
use Throwable;

/**
 * Class Invalid
 * @package Horat1us\Environment\Exception
 */
class Invalid extends \DomainException implements Environment\Exception
{
    /** @var mixed */
    protected $value;

    public function __construct($value, string $message = "", int $code = 0, Throwable $previous = null)
    {
        $this->value = $value;
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return parent::__toString() . PHP_EOL . "Value: " . var_export($this->value, true);
    }
}
