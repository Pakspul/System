<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\NonNegativeInteger;

final class NonNegativeIntegerTest extends TestCase
{
    public function testTryCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NonNegativeInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithZeroValue()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NonNegativeInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithNegativeValue()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NonNegativeInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testTryCreateWithNonInteger()
    {
        // Arrange
        $value = "abc";

        // Act
        $result = NonNegativeInteger::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateWithNegativeValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid non negative integer.");

        // Arrange
        $value = -1;

        // Act
        NonNegativeInteger::create($value);
    }

    public function testCreateMethodSuccessfully()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = NonNegativeInteger::create($value);

        // Assert
        $this->assertEquals($value, $integer->getValue());
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = NonNegativeInteger::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $integer);
    }
}
