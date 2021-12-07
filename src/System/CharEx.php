<?php

namespace System;

final class CharEx
{
    // https://referencesource.microsoft.com/#mscorlib/system/char.cs,33d30f343eda0003
    // mist nog twee...
    public static function IsWhiteSpace(string $char)
    {
        if (StringEx::Length($char) > 1) {
            throw new \Exception("Char may not be longer than one character.");
        }

        if ($char === ' ' || (ord($char) >= 9 && ord($char) <= 13)) {
            return true;
        }

        return false;
    }
}
