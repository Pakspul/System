<?php

declare (strict_types = 1);

use PHPUnit\Framework\TestCase;
use System\StringEx;

final class StringExTest extends TestCase
{
    /**
     * String::IsNullOrEmpty tests
     */
    public function testIsNullIsNullOrEmpty()
    {
        // Arrange
        $value = null;

        // Act
        $result = StringEx::IsNullOrEmpty($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIfEmptyStringIsEmpty()
    {
        // Arrange
        $value = "";

        // Act
        $result = StringEx::IsNullOrEmpty($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testStringWithLengthTenIsNotEmpty()
    {
        // Arrange
        $value = "1234567890";

        // Act
        $result = StringEx::IsNullOrEmpty($value);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * String::Length tests
     */
    public function testHelloWorldStringToHaveLengthOfEleven(): void
    {
        // Arrange
        $input = "Hello world";

        // Act
        $result = StringEx::Length($input);

        // Assert
        $this->assertEquals(11, $result);
    }
}
