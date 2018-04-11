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
    public function testPrefix()
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

    public function testDefault()
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

    public function testMissingDefault()
    {
        $config = new class extends Environment\Config
        {
            public function getValue(): int
            {
                return $this->getEnv("KEY");
            }
        };
        putenv("KEY"); // remove KEY from environment
        $this->expectException(\DomainException::class);
        $config->getValue();
    }
}
