<?php

namespace Horat1us\Environment;

use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;
use Dotenv\Repository\RepositoryInterface;

/**
 * Trait ConfigTrait
 * @package Horat1us\Environment
 */
trait ConfigTrait
{
    protected RepositoryInterface $environment;

    protected function getEnv(string $key, $default = null)
    {
        $prefixed = $this->getEnvironmentKeyPrefix() . $key;
        $value = $this->environment->get($prefixed) ?? $default;

        if (is_null($value)) {
            throw new Exception\ValidationException($prefixed);
        }
        if ($value instanceof \Closure || is_array($value) && is_callable($value)) {
            return call_user_func($value, $key, $prefixed);
        }
        return $value;
    }

    public function setEnvironment(RepositoryInterface $environment = null): void
    {
        if (is_null($environment)) {
            $environment = RepositoryBuilder::createWithDefaultAdapters()
                ->addAdapter(PutenvAdapter::class)
                ->make();
        }
        $this->environment = $environment;
    }

    final protected function null(): void
    {
    }

    abstract protected function getEnvironmentKeyPrefix(): string;
}
