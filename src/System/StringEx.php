<?php

namespace System;

final class StringEx
{
    private function __construct()
    {}

    public static function IsNullOrEmpty(string $value = null): bool
    {
        return ($value == null || StringEx::Length($value) === 0);
    }

    public static function Length(string $value): int
    {
        return (int) strlen($value);
    }
}
