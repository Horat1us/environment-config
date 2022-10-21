<?php

declare(strict_types=1);

namespace Horat1us\Environment;

/**
 * Class MagicTrait
 * @package Horat1us\Environment
 */
trait MagicTrait
{
    use ConfigTrait;

    /**
     * @param string $callerName
     * @return string
     */
    private function getEnvironmentKeySuffix(string $callerName): string
    {
        if (strlen($callerName) < 3
            || strpos($callerName, "get") !== 0
        ) {
            throw new \RuntimeException("Trait method must be named as get{getEnvironmentKeySuffix}");
        }

        $methodName = substr($callerName, 3, strlen($callerName) - 3);
        // map camelCase string to CAMEL_CASE
        $suffix = strtoupper(
            substr(
                preg_replace('/([A-Z])/', '_$1', $methodName),
                1,
                strlen($methodName) * 2
            )
        );

        return $suffix;
    }

    /**
     * @throws Exception\Missing
     * @return array|false|mixed|null|string
     */
    private function getEnvironment()
    {
        $fieldName = $this->getEnvironmentKeySuffix(
            $this->getCalledMethod()
        );

        return $this->getEnv($fieldName);
    }

    private function getCalledMethod(): string
    {
        return debug_backtrace()[1]['function'];
    }
}
