<?php

declare (strict_types = 1);

use PHPUnit\Framework\TestCase;

final class StringExTest extends TestCase
{
    public function testHelloWorldStringToHaveLengthOfEleven(): void
    {
        // Arrange
        $input = "Hello world";

        // Act
        $result = \System\StringEx::Length($input);

        // Assert
        $this->assertEquals(11, $result);
    }
}
