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
     * String::IsNullOrWhiteSpace tests
     */
    public function testIsNullOrWhiteSpaceWithNull()
    {
        // Arrange
        $value = null;

        // Act
        $result = StringEx::IsNullOrWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIsNullOrWhiteSpaceWithEmptyString()
    {
        // Arrange
        $value = "";

        // Act
        $result = StringEx::IsNullOrWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIsNullOrWhiteSpaceWithSpaceString()
    {
        // Arrange
        $value = " ";

        // Act
        $result = StringEx::IsNullOrWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIsNullOrWhiteSpaceWithWhiteSpaceFilledString()
    {
        // Arrange
        $value = " \t \r \n \f \v ";

        // Act
        $result = StringEx::IsNullOrWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testIsNullOrWhiteSpaceWithSpacePaddedString()
    {
        // Arrange
        $value = " ABCDE ";

        // Act
        $result = StringEx::IsNullOrWhiteSpace($value);

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

    /**
     * String::Trim tests
     */
    public function testTrimStringWithOnlyASpace()
    {
        // Arrange
        $value = " ";

        // Act
        $result = StringEx::Trim($value);

        // Assert
        $this->assertEmpty($result);
    }

    public function testTrimSpacedPaddedString()
    {
        // Arrange
        $value = " ABC ";

        // Act
        $result = StringEx::Trim($value);

        // Assert
        $this->assertEquals("ABC", $result);
    }

    public function testConvertToLowercase()
    {
        // Arrange
        $value = "ABC";

        // Act
        $result = StringEx::ToLower($value);

        // Assert
        $this->assertEquals("abc", $result);
    }

    public function testConvertToUppercase()
    {
        // Arrange
        $value = "abc";

        // Act
        $result = StringEx::ToUpper($value);

        // Assert
        $this->assertEquals("ABC", $result);
    }
}
