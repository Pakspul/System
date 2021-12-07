<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\NonNegativeNumber;

final class NonNegativeNumberTest extends TestCase
{
    public function testTryCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NonNegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithZeroValue()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NonNegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithNegativeValue()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NonNegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithNonInteger()
    {
        // Arrange
        $value = "abc";

        // Act
        $result = NonNegativeNumber::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateWithPostiveValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid non negative number.");

        // Arrange
        $value = -1;

        // Act
        NonNegativeNumber::create($value);
    }

    public function testCreateMethodSuccessfully()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = NonNegativeNumber::create($value);

        // Assert
        $this->assertEquals($value, $integer->getValue());
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = NonNegativeNumber::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $integer);
    }
}
