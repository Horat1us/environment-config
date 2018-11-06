<?php

namespace Horat1us\Environment;

/**
 * Class Enum
 * @package Horat1us\Environment
 */
class Enum
{
    /** @var array */
    protected $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param mixed $value
     *
     * @throws Exception\Invalid
     */
    public function validate($value): void
    {
        if (in_array($value, $this->values)) {
            return;
        }

        throw new Exception\Invalid(
            $value,
            "Invalid value, expected one of " . implode(",", $this->valuesString())
        );
    }

    public static function boolean(): Enum
    {
        return new static([true, false, "0", "1", 0, 1]);
    }

    /**
     * @param string $className
     * @param string|null $prefix
     * @param array $except
     * @return Enum
     * @throws \ReflectionException
     */
    public static function fromConstants(string $className, string $prefix = null, array $except = []): Enum
    {
        static $cache = [];

        if (!isset($cache[$className])) {
            $reflection = new \ReflectionClass($className);
            $cache[$className] = $reflection->getConstants();
        }

        $values = $cache[$className];

        if ($prefix) {
            foreach ($values as $name => $v) {
                if (mb_strpos($name, $prefix) !== 0) {
                    unset($values[$name]);
                }
            }
        }

        if ($except) {
            $values = array_filter($values, function ($value) use ($except): bool {
                return !in_array($value, $except, true);
            });
        }

        return new Enum($values);
    }

    final protected function valuesString(): array
    {
        return array_map(function ($value): string {
            if (is_scalar($value) || is_object($value) && method_exists($value, '__toString')) {
                return (string)$value;
            }
            return var_export($value, true);
        }, $this->values);
    }
}
