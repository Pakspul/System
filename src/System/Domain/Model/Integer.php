<?php

namespace System\Domain\Model;

use System\Domain\Exception\DomainException;
use System\Domain\ValueObject;
use System\IntegerEx;
use System\Result;

class Integer extends ValueObject
{
    public static function create($value)
    {
        $result = Integer::tryCreate($value);
        if ($result->isFailure()) {
            throw DomainException::createFromResult($result);
        }

        return new Integer($value);
    }

    public static function tryCreate($value): Result
    {
        return self::isValid($value);
    }

    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function equals(Integer $other): bool
    {
        return ($this->value === $other->getValue());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function isValid($value): Result
    {
        if (!IntegerEx::tryParse($value)) {
            return Result::Failure("INTEGER_IS_NOT_VALID", "Value is not a valid integer.");
        }

        return Result::Success();
    }
}
