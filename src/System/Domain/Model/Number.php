<?php

namespace System\Domain\Model;

use System\Domain\Exception\DomainException;
use System\Domain\ValueObject;
use System\NumericEx;
use System\Result;

class Number extends ValueObject
{
    public static function create($value)
    {
        $result = Number::tryCreate($value);
        if ($result->isFailure()) {
            throw DomainException::createFromResult($result);
        }

        return new Number($value);
    }

    public static function tryCreate($value): Result
    {
        return self::isValid($value);
    }

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function equals(Number $other): bool
    {
        return ($this->value === $other->getValue());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function isValid($value): Result
    {
        if (!NumericEx::tryParse($value)) {
            return Result::Failure("NUMBER_IS_NOT_VALID", "Value is not a valid number.");
        }

        return Result::Success();
    }
}
