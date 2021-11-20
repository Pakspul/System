<?php

namespace System;

final class StringEx
{
    private function __construct()
    {}

    public static function IsNullOrWhiteSpace(string $value = null): bool
    {
        if ($value === null) {
            return true;
        }

        $length = StringEx::Length($value);
        for ((int) $i = 0; $i < $length; $i++) {
            if (!CharEx::IsWhiteSpace($value[$i])) {
                return false;
            }

        }

        return true;
    }

    public static function IsNullOrEmpty(string $value = null): bool
    {
        return ($value == null || StringEx::Length($value) === 0);
    }

    public static function Length(string $value): int
    {
        return (int) strlen($value);
    }

    // https://referencesource.microsoft.com/#mscorlib/system/string.cs,628f74f98ae9d848,references
    public static function Trim(string $value): string
    {
        return trim($value);
    }

    public static function TrimStart(string $value): string
    {
        return ltrim($value);
    }

    public static function TrimEnd(string $value): string
    {
        return rtrim($value);
    }

    public static function ToLower(string $value): string
    {
        return strtolower($value);
    }

    public static function ToUpper(string $value): string
    {
        return strtoupper($value);
    }
}
