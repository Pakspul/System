<?php

namespace System\Domain\Model;

use System\Domain\Exception\DomainException;
use System\NumericEx;
use System\Result;

class PositiveNumber extends Number
{
    public static function create($value)
    {
        $result = self::tryCreate($value);
        if ($result->isFailure()) {
            throw DomainException::createFromResult($result);
        }

        return new PositiveNumber($value);
    }

    public static function tryCreate($value): Result
    {
        return self::isValid($value);
    }

    private $value;

    private function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function isValid($value): Result
    {
        $result = parent::tryCreate($value);
        if ($result->isFailure()) {
            return $result;
        }

        if (!NumericEx::isPositive($value)) {
            return Result::Failure("POSITIVE_NUMBER_NOT_VALID", "Value is not a valid positive number.");
        }

        return Result::Success();
    }
}
