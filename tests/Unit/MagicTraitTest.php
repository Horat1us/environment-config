<?php

declare(strict_types=1);

namespace Horat1us\Environment\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Horat1us\Environment;

/**
 * Class MagicTraitTest
 * @package Horat1us\Environment\Tests\Unit
 */
class MagicTraitTest extends TestCase
{
    /** @var Environment\Tests\Mock\MagicConfig */
    public $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = new Environment\Tests\Mock\MagicConfig();
    }

    public function testGetMethodValue(): void
    {
        putenv('TEST_HOST=horatius.pro');
        $host = $this->config->getHost();
        $this->assertEquals('horatius.pro', $host);
    }

    public function testGetMethodFailed(): void
    {
        putenv('TEST_HOST');
        $this->expectException(Environment\Exception\Missing::class);
        $this->config->getHost();
    }

    public function testInvalidMethodName(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Trait method must be named as get{getEnvironmentKeySuffix}');
        $this->config->invalidMethodName();
    }
}
