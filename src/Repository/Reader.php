<?php declare(strict_types=1);

namespace Horat1us\Environment\Repository;

use Dotenv\Repository\Adapter\ReaderInterface;
use Dotenv\Repository\RepositoryInterface;
use PhpOption\Option;
use PhpOption\Some;

class Reader implements ReaderInterface
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function read(string $name): Option
    {
        return Some::fromValue($this->repository->get($name));
    }
}
