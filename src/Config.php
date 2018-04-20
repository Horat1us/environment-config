<?php

namespace Horat1us\Environment;

/**
 * Class Config
 * @package Horat1us\Environment
 */
abstract class Config
{
    use ConfigTrait;

    /** @var string */
    private $keyPrefix;

    public function __construct(string $keyPrefix = '')
    {
        $this->keyPrefix = $keyPrefix;
    }

    protected function getEnvironmentKeyPrefix(): string
    {
        return $this->keyPrefix;
    }
}
