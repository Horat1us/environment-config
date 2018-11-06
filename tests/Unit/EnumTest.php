<?php

namespace Horat1us\Environment\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Horat1us\Environment\Enum;

/**
 * Class EnumTest
 * @package Horat1us\Environment\Tests\Unit
 * @coversDefaultClass \Horat1us\Environment\Enum
 * @internal
 */
class EnumTest extends TestCase
{
    public const VALUE_STRING = 'string';
    public const VALUE_INT = 123;
    public const VALUE_FLOAT = 123.456;
    public const VALUE_ARRAY = [1, 2, 3,];
    public const VALUE_BOOL = true;
    public const VALUE_NULL = null;
    public const MOCK = 'mock';

    public function testSuccessValidate(): void
    {
        $enum = new Enum([
            static::VALUE_STRING,
            static::VALUE_INT,
            static::VALUE_FLOAT,
            static::VALUE_ARRAY,
        ]);

        $enum->validate(static::VALUE_STRING);
        $enum->validate(static::VALUE_INT);
        $enum->validate(static::VALUE_FLOAT);
        $enum->validate(static::VALUE_ARRAY);

        $this->assertTrue(true);
    }

    /**
     * @expectedException \Horat1us\Environment\Exception\Invalid
     */
    public function testFailureValidate(): void
    {
        $enum = new Enum([
            static::VALUE_STRING,
            static::VALUE_INT,
            static::VALUE_FLOAT,
            static::VALUE_ARRAY,
            static::VALUE_NULL,
            new class
            {
                public function __toString(): string
                {
                    return 'Anonymous';
                }
            },
            new \stdClass()
        ]);

        $enum->validate(static::MOCK);
    }

    public function testFromConstants(): void
    {
        $enum = Enum::fromConstants(static::class, 'VALUE_', [static::VALUE_ARRAY]);

        $this->assertEquals(
            new Enum([
                'VALUE_STRING' => static::VALUE_STRING,
                'VALUE_INT' => static::VALUE_INT,
                'VALUE_FLOAT' => static::VALUE_FLOAT,
                'VALUE_BOOL' => static::VALUE_BOOL,
                'VALUE_NULL' => static::VALUE_NULL,
            ]),
            $enum
        );
    }

    public function testBoolean(): void
    {
        $this->assertEquals(
            new Enum([true, false, "0", "1", 0, 1]),
            Enum::boolean()
        );
    }
}
