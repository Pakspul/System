<?php

namespace System\Test;

use PHPUnit\Framework\TestCase;
use System\CharEx;

/**
 * @group System
 * @group System.CharEx
 */
class CharExTest extends TestCase
{
    public function testEmptyStringIsWhiteSpace()
    {
        // Arrange
        $value = "";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testSpaceIsWhiteSpace()
    {
        // Arrange
        $value = " ";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testTabIsWhiteSpace()
    {
        // Arrange
        $value = "\t";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testCarriageReturnIsWhiteSpace()
    {
        // Arrange
        $value = "\r";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testNewLineIsWhiteSpace()
    {
        // Arrange
        $value = "\n";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testVerticalTabIsWhiteSpace()
    {
        // Arrange
        $value = "\v";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testFormFeedIsWhiteSpace()
    {
        // Arrange
        $value = "\f";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testLetterIsNotWhiteSpace()
    {
        // Arrange
        $value = "A";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testNumberIsNotWhiteSpace()
    {
        // Arrange
        $value = "1";

        // Act
        $result = CharEx::IsWhiteSpace($value);

        // Assert
        $this->assertFalse($result);
    }
}
