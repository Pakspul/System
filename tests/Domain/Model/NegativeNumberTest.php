<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\NegativeNumber;

final class NegativeNumberTest extends TestCase
{
    public function testTryCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithZeroValue()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithNegativeValue()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithNonNumber()
    {
        // Arrange
        $value = "abc";

        // Act
        $result = NegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateWithPositiveValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid negative number.");

        // Arrange
        $value = 1;

        // Act
        NegativeNumber::create($value);
    }

    public function testCreateMethodSuccessfully()
    {
        // Arrange
        $value = -1;

        // Act
        $integer = NegativeNumber::create($value);

        // Assert
        $this->assertEquals($value, $integer->getValue());
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = -1;

        // Act
        $integer = NegativeNumber::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $integer);
    }
}
