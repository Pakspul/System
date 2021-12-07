<?php

declare (strict_types = 1);

namespace tests;

use PHPUnit\Framework\TestCase;
use System\NumericEx;

final class NumericExTest extends TestCase
{
    public function testPositiveValueIsPositive()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NumericEx::isPositive($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testZeroValueIsNotPositive()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NumericEx::isPositive($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testNegativeValueIsNotPositive()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NumericEx::isPositive($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testPositiveValueIsNonNegative()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NumericEx::isNonNegative($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testZeroValueIsNonNegative()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NumericEx::isNonNegative($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testNegativeValueIsNotNonNegative()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NumericEx::isNonNegative($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testPositiveValueIsNotNegative()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NumericEx::isNegative($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testZeroValueIsNotNegative()
    {
        // Arrange
        $value = 0;

        // Act
        $result = NumericEx::isNegative($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testNegativeValueIsNegative()
    {
        // Arrange
        $value = -1;

        // Act
        $result = NumericEx::isNegative($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIntegertryParseNumeric()
    {
        // Arrange
        $value = 1;

        // Act
        $result = NumericEx::tryParse($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testNumbertryParseNumeric()
    {
        // Arrange
        $value = 1.1;

        // Act
        $result = NumericEx::tryParse($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testStringIsNotANumeric()
    {
        // Arrange
        $value = "numeric";

        // Act
        $result = NumericEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }
}
