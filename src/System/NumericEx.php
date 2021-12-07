<?php

namespace System;

final class NumericEx
{
    private function __construct()
    {
    }

    public static function isPositive($value): bool
    {
        // todo, is numeric check
        return ($value > 0);
    }

    public static function isNonNegative($value): bool
    {
        // todo, is numeric check
        return ($value >= 0);
    }

    public static function isNegative($value): bool
    {
        // todo, is numeric check
        return ($value < 0);
    }

    public static function tryParse($value): bool
    {
        return is_numeric($value);
    }
}
