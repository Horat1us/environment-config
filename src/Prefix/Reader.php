<?php declare(strict_types=1);

namespace Horat1us\Environment\Prefix;

use Dotenv\Repository\Adapter\ReaderInterface;

final class Reader implements ReaderInterface
{
    use FilterTrait;

    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader, string $prefix)
    {
        $this->reader = $reader;
        $this->prefix = $prefix;
    }

    public function read(string $name)
    {
        $this->filter($name);
        return $this->reader->read($name);
    }
}
