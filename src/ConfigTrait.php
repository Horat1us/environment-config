<?php

namespace Horat1us\Environment;

/**
 * Trait ConfigTrait
 * @package Horat1us\Environment
 */
trait ConfigTrait
{
    protected function getEnv(string $key, $default = null)
    {
        $prefixed = $this->getEnvironmentKeyPrefix() . $key;
        $value = getenv($prefixed);

        if ($value === false) {
            if (is_null($default)) {
                throw new MissingEnvironmentException($prefixed);
            }

            if ($default instanceof \Closure || is_array($default) && is_callable($default)) {
                $default = call_user_func($default, $key, $prefixed);
            }

            return $default;
        }

        return $value;
    }

    /**
     * Support method for getEnv
     * Can be used as second argument:
     *
     * ```php
     * $this->getEnv('KEY', [$this, 'null']);
     * ```
     *
     * @return null
     */
    protected function null()
    {
        return null;
    }

    abstract protected function getEnvironmentKeyPrefix(): string;
}
