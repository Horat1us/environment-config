<?php

namespace Horat1us\Environment\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Horat1us\Environment\Exception\Invalid;

/**
 * Class InvalidTest
 * @package Horat1us\Environment\Tests\Unit\Exception
 * @coversDefaultClass \Horat1us\Environment\Exception\Invalid
 * @internal
 */
class InvalidTest extends TestCase
{
    protected const VALUE = 'value';
    protected const MESSAGE = 'message';

    /** @var Invalid */
    protected $fakeInvalid;

    protected function setUp(): void
    {
        $this->fakeInvalid = new Invalid(static::VALUE, static::MESSAGE);
    }

    public function testToString(): void
    {
        $expectedExceptionStringConversion = Invalid::class . ': '
            . $this->fakeInvalid->getMessage() .' in '
            . $this->fakeInvalid->getFile() . ':'
            . $this->fakeInvalid->getLine(). PHP_EOL
            . 'Stack trace:' . PHP_EOL
            . $this->fakeInvalid->getTraceAsString() . PHP_EOL
            . "Value: '" . static::VALUE . "'";

        $this->assertEquals($expectedExceptionStringConversion, (string)$this->fakeInvalid);
    }
}
