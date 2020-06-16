<?php declare(strict_types=1);

namespace Horat1us\Environment\Exception;

use Horat1us\Environment;

class ValidationException extends \RuntimeException implements Environment\Exception
{
    public function __construct(string $key, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("Missing environment key {$key}", $code, $previous);
    }
}
