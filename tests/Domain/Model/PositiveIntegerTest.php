<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\PositiveInteger;

final class PositiveIntegerTest extends TestCase
{
    public function testTryCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $result = PositiveInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithZeroValue()
    {
        // Arrange
        $value = 0;

        // Act
        $result = PositiveInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithNegativeValue()
    {
        // Arrange
        $value = -1;

        // Act
        $result = PositiveInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithStringValue()
    {
        // Arrange
        $value = "abc";

        // Act
        $result = PositiveInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = PositiveInteger::create($value);

        // Assert
        $this->assertEquals($value, $integer->getValue());
    }

    public function testCreateWithZeroValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid positive integer.");

        // Arrange
        $value = 0;

        // Act
        PositiveInteger::create($value);
    }

    public function testCreateWithNegativeValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid positive integer.");

        // Arrange
        $value = 0;

        // Act
        PositiveInteger::create($value);
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = PositiveInteger::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $integer);
    }
}
