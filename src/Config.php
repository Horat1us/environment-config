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

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     * @throws MissingEnvironmentException
     */
    protected function getEnv(string $key, $default = null)
    {
        $prefixed = $this->keyPrefix . $key;
        $value = getenv($prefixed);

        if ($value === false) {
            if (!is_null($default)) {
                return $default;
            }
            throw new MissingEnvironmentException($prefixed);
        }

        return $value;
    }
}
