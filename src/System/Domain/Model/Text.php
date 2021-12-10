<?php

namespace System\Domain\Model;

use System\Domain\ValueObject;
use System\StringEx;

class Text extends ValueObject
{
    public static function create(string $value)
    {
        $value = StringEx::Trim($value);

        return new Text($value);
    }

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
