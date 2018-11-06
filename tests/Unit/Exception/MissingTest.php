<?php

namespace Horat1us\Environment\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Horat1us\Environment\Exception\Missing;

/**
 * Class MissingTest
 * @package Horat1us\Environment\Tests\Unit\Exception
 * @coversDefaultClass \Horat1us\Environment\Exception\Missing
 * @internal
 */
class MissingTest extends TestCase
{
    protected const KEY = 'test_key';

    /** @var Missing */
    protected $fakeMissing;

    protected function setUp(): void
    {
        $this->fakeMissing = new Missing(static::KEY);
    }

    public function testGetKey(): void
    {
        $this->assertEquals(static::KEY, $this->fakeMissing->getKey());
    }
}
