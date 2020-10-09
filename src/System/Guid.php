<?php

namespace System;

final class Guid
{
    public const empty = '00000000-0000-0000-0000-000000000000';

    private $value;

    public function __construct(string $value)
    {
        if (!preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', $value)) {
            throw new \Exception("The format of value is invalid.");
        }

        $this->value = $value;
    }

    function empty(): Guid {
        return new static(self::empty);
    }

    public static function newGuid(): Guid
    {
        return new static(sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        ));
    }

    public static function isEmpty(Guid $value)
    {
        return (self::empty === (string) $value);
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function tryParse(string $input, Guid &$result = null)
    {
        if (!preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', $input)) {
            return false;
        }

        $result = new static($input);

        return true;
    }

    public static function parse(string $input): Guid
    {
        $result = null;
        if (!self::tryParse($input, $result)) {
            throw new \Exception("The format of value is invalid.");
        }

        return $result;
    }

    /**
     * @return Bool
     */
    public function equals(Guid $other): bool
    {
        return ($this->value === (string) $other);
    }
}
