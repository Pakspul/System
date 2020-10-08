<?php

namespace System;

final class StringEx
{
    private function __construct()
    {}

    public static function Length(string $value): int
    {
        return (int) strlen($value);
    }
}
