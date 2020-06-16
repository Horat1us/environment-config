<?php declare(strict_types=1);

namespace Horat1us\Environment;

use Dotenv\Repository\RepositoryInterface;

abstract class Config
{
    use ConfigTrait;

    /** @var string */
    private string $keyPrefix;

    public function __construct(string $keyPrefix = '', RepositoryInterface $repository = null)
    {
        $this->keyPrefix = $keyPrefix;
        $this->setEnvironment($repository);
    }

    protected function getEnvironmentKeyPrefix(): string
    {
        return $this->keyPrefix;
    }
}
