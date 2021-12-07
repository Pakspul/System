<?php

namespace System;

final class IntegerEx
{
    private function __construct()
    {
    }

    public static function tryParse($value): bool
    {
        return is_int($value);
    }
}
