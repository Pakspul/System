<?php

declare (strict_types = 1);

namespace tests;

use PHPUnit\Framework\TestCase;
use System\IntegerEx;

final class IntegerExTest extends TestCase
{
    public function testIntegerValuetryParsenInteger()
    {
        // Arrange
        $value = 1;

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testDoubleIsNotAnInteger()
    {
        // Arrange
        $value = 1.2;

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testStringWithIntegerIsNotAnInteger()
    {
        // Arrange
        $value = "123";

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testNullIsNotAnInteger()
    {
        // Arrange
        $value = null;

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testTrueBooleanIsNotAnInteger()
    {
        // Arrange
        $value = true;

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testFalseBooleanIsNotAnInteger()
    {
        // Arrange
        $value = false;

        // Act
        $result = IntegerEx::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }
}
