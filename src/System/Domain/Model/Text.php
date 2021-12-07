<?php

namespace System\Domain\Model;

use System\Domain\ValueObject;
use System\StringEx;

class Text extends ValueObject
{
    public static function create(string $value)
    {
        if (StringEx::IsNullOrWhiteSpace($value)) {
            throw new \Exception("Text may not be empty or only contain whitespaces.");
        }

        $value = StringEx::Trim($value);

        return new Text($value);
    }

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
