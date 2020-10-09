<?php

namespace System;

abstract class Enum
{
    /**
     * Enum value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Store existing constants in a static cache per object.
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @return mixed
     */
    public function getKey()
    {
        return static::search($this->value);
    }

    final public function __construct(string $value, bool $ignoreCase = false)
    {
        if (!self::isValid($value, $ignoreCase)) {
            throw new \Exception("value is outside the range of the underlying type of enumType.");
        }

        $this->value = $this->translateValue($value);
    }

    public static function tryParse(string $value, Enum &$result = null, bool $ignoreCase = false)
    {
        if (!self::isValid($value, $ignoreCase)) {
            return false;
        }

        $result = new static($value, $ignoreCase);

        return true;
    }

    public static function parse(string $value, bool $ignoreCase = false)
    {
        if (!self::isValid($value, $ignoreCase)) {
            throw new \Exception("value is outside the range of the underlying type of enumType.");
        }

        return new static($value, $ignoreCase);
    }

    public static function __callStatic($value, $arguments)
    {
        if (!self::isValid($value, false)) {
            throw new \Exception("value is outside the range of the underlying type of enumType.");
        }

        return new static($value);
    }

    public static function search($value)
    {
        return \array_search($value, static::toArray(), true);
    }

    private function translateValue(string $value)
    {
        $keyUpperCase = strtoupper($value);
        $keyValueMap = static::toArray();
        return $keyValueMap[$keyUpperCase];

        // @todo, deze functie herschrijven, want het is niet helder wat hier gebeurd
        // volgens mij een voor key naar value translation
        $originalValues = array_values(static::toArray());
        $values = array_map('strtolower', $originalValues);
        $key = array_search(strtolower($value), $values);
        return $originalValues[$key];
    }

    private static function toArray()
    {
        $class = \get_called_class();
        if (!isset(static::$cache[$class])) {
            $reflection            = new \ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }
        return static::$cache[$class];
    }

    private static function isValid(string $value, bool $ignoreCase)
    {
        $keys = array_keys(static::toArray());
        if ($ignoreCase) {
            $values = array_map('strtolower', $keys);
            return in_array(strtolower($value), $values, true);
        }

        return in_array($value, $keys, true);
    }

    public function __toString()
    {
        return $this->value;
    }
}
