<?php declare(strict_types=1);

namespace Horat1us\Environment\Prefix;

trait FilterTrait
{
    private string $prefix;

    public function getPrefix(): string {
        return $this->prefix;
    }

    public function setPrefix(string $prefix = ''): void {
        $this->prefix = $prefix;
    }

    private function filter(string &$name): void
    {
        $name = $this->prefix . $name;
    }
}
