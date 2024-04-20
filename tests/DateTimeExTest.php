<?php

namespace System\Test;

use PHPUnit\Framework\TestCase;
use System\DateTimeEx;
use System\DateTimeZoneEx;

/**
 * @group System
 * @group System.DateTimeEx
 */
class DateTimeExTest extends TestCase
{
    public function testParseValidDateTimeString()
    {
        // Assert
        $now = new \DateTime(date(\System\DateTimeEx::ISO8601_DATETIME_SECONDS));
        $string = $now->format(\System\DateTimeEx::ISO8601_DATETIME_SECONDS);

        // Act
        $dt = DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME_SECONDS);

        // Arrange
        $this->assertEquals($now, $dt);
    }

    public function testParseInvalidDateTimeString()
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('does not contain a valid string representation of a date and time');

        // Arrange
        $string = "invalid string";

        // Act
        DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME_SECONDS);
    }

    public function testParseUtcToEuropeAmsterdamTimezone()
    {
        // Assert
        $now = new \DateTime(date(\System\DateTimeEx::ISO8601_DATETIME_SECONDS));
        $now->setTimezone(new \DateTimeZone("UTC"));
        $string = $now->format(\System\DateTimeEx::ISO8601_DATETIME_SECONDS);

        // Act
        $dt = DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME_SECONDS, DateTimeZoneEx::EUROPE_AMSTERDAM());

        // Assert
        $this->assertEquals("Europe/Amsterdam", $dt->getTimezone()->getName());
    }

    public function testToUtcWithMillisecondFormat()
    {
        // Assert
        $dt = new \DateTime("2024-01-01 12:34:56.123456");

        // Act
        $formatted = $dt->format(\System\DateTimeEx::ISO8601_DATETIME_MILLISECONDS);

        // Arrange
        $this->assertEquals("2024-01-01T12:34:56.123+0100", $formatted);
    }

    public function testToUtcWithMicrosecondFormat()
    {
        // Assert
        $dt = new \DateTime("2024-01-01 12:34:56.123456");

        // Act
        $formatted = $dt->format(\System\DateTimeEx::ISO8601_DATETIME_MICROSECONDS);

        // Arrange
        $this->assertEquals("2024-01-01T12:34:56.123456+0100", $formatted);
    }
}
