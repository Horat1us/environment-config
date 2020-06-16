<?php declare(strict_types=1);

namespace Horat1us\Environment\Prefix;

use Dotenv\Repository\Adapter\WriterInterface;

final class Writer implements WriterInterface
{
    use FilterTrait;

    private WriterInterface $writer;

    public function __construct(WriterInterface $writer, string $prefix)
    {
        $this->writer = $writer;
        $this->prefix = $prefix;
    }

    public function write(string $name, string $value)
    {
        $this->filter($name);
        return $this->writer->write($name, $value);
    }

    public function delete(string $name)
    {
        $this->filter($name);
        return $this->writer->delete($name);
    }
}
