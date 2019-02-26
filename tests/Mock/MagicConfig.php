<?php

declare(strict_types=1);

namespace Horat1us\Environment\Tests\Mock;

use Horat1us\Environment;

/**
 * Class MagicConfigTest
 * @package Horat1us\Environment\Tests\Mock
 * @internal
 */
class MagicConfig
{
    use Environment\MagicTrait {
        getEnvironment as public getHost;
        getEnvironment as public invalidMethodName;
    }

    protected function getEnvironmentKeyPrefix(): string
    {
        return 'TEST_';
    }
}
