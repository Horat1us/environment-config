<?php

namespace Horat1us\Environment\Tests;

use Horat1us\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigTest
 * @package Horat1us\Environment\Tests
 * @internal
 */
class ConfigTest extends TestCase
{
    public function testPrefix(): void
    {
        $config = new class("PREFIX_") extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY");
            }
        };
        putenv("PREFIX_KEY=5");
        $this->assertEquals(5, $config->getValue());
    }

    public function testDefault(): void
    {
        $config = new class extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY", 10);
            }
        };
        putenv("KEY"); // remove KEY from environment
        $this->assertEquals(10, $config->getValue());
    }

    public function testDefaultStringCallable(): void
    {
        $config = new class extends Environment\Config
        {
            public function getValue(): string
            {
                return $this->getEnv("KEY", "substr");
            }
        };
        putenv("KEY");
        $this->assertEquals("substr", $config->getValue());
    }

    public function testDefaultArrayCallable(): void
    {
        $config = new class extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY", [$this, 'calculateDefault']);
            }

            protected function calculateDefault(): int
            {
                return 2 + 2; // very slow operation
            }
        };
        putenv("KEY");
        $this->assertEquals(4, $config->getValue());
    }

    public function testDefaultClosure(): void
    {
        $config = new class extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY", function (): int {
                    return 1 + 1; // some slow operation
                });
            }
        };
        putenv("KEY");
        $this->assertEquals(2, $config->getValue());
    }

    public function testDefaultNull(): void
    {
        $config = new class extends Environment\Config
        {
            public function getNullValue()
            {
                return $this->getEnv("KEY", [$this, 'null']);
            }
        };
        putenv("KEY");
        $this->assertNull($config->getNullValue());
    }

    /**
     * @expectedException \Horat1us\Environment\MissingEnvironmentException
     */
    public function testMissingDefault(): void
    {
        $prefix = 'testPrefix';

        $config = new class($prefix) extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY");
            }
        };
        putenv("{$prefix}KEY"); // remove KEY from environment
        try {
            $config->getValue();
        } catch (Environment\MissingEnvironmentException $exception) {
            $this->assertEquals($exception->getKey(), "{$prefix}KEY");
            throw $exception;
        }
    }
}
