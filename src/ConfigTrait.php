<?php

namespace Horat1us\Environment;

/**
 * Trait ConfigTrait
 * @package Horat1us\Environment
 */
trait ConfigTrait
{
    /**
     * @param string $key
     * @param null $default
     * @throws Exception\Missing
     * @return array|false|mixed|null|string
     */
    protected function getEnv(string $key, $default = null)
    {
        $prefixed = $this->getEnvironmentKeyPrefix() . $key;
        $value = getenv($prefixed);

        if ($value === false) {
            if (is_null($default)) {
                throw new Exception\Missing($prefixed);
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
     * @since 1.2.1
     * @return null
     */
    final protected function null()
    {
        return null;
    }

    abstract protected function getEnvironmentKeyPrefix(): string;
}
