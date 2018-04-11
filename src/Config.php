<?php

namespace Horat1us\Environment;

/**
 * Class Config
 * @package Horat1us\Environment
 */
abstract class Config
{
    /** @var string  */
    private $keyPrefix;

    public function __construct(string $keyPrefix = '')
    {
        $this->keyPrefix = $keyPrefix;
    }

    protected function getEnv(string $key, $default = null)
    {
        $value = getenv($this->keyPrefix . $key);

        if ($value === false) {
            if (!is_null($default)) {
                return $default;
            }
            throw new \DomainException("Missing environment key $key");
        }

        return $value;
    }
}
