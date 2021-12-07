<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\Number;

final class NumberTest extends TestCase
{
    public function testTryCreateWithPositiveValue()
    {
        // Arrange
        $value = 1;

        // Act
        $result = Number::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testTryCreateWithStringValue()
    {
        // Arrange
        $value = "test";

        // Act
        $result = Number::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateWithStringValue()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid number.");

        // Arrange
        $value = "test";

        // Act
        Number::create($value);
    }

    public function testcreateWithValidValue()
    {
        // Arrange
        $value = 1;

        // Act
        $number = Number::create($value);

        // Assert
        $this->assertEquals($value, $number->getValue());
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = 1;

        // Act
        $number = Number::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $number);
    }

    public function testEqualsWithSameValue()
    {
        // Arrenge
        $number1 = Number::create(1);
        $number2 = Number::create(1);

        // Act
        $result = $number1->equals($number2);

        // Assert
        $this->assertTrue($result);
    }

    public function testNotEqualWithDiffertValue()
    {
        // Arrenge
        $number1 = Number::create(1);
        $number2 = Number::create(2);

        // Act
        $result = $number1->equals($number2);

        // Assert
        $this->assertFalse($result);
    }
}
