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
        $now = new \DateTime(date(\System\DateTimeEx::ISO8601_DATETIME));
        $string = $now->format(\System\DateTimeEx::ISO8601_DATETIME);

        // Act
        $dt = DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME);

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
        DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME);
    }

    public function testParseUtcToEuropeAmsterdamTimezone()
    {
        // Assert
        $now = new \DateTime(date(\System\DateTimeEx::ISO8601_DATETIME));
        $now->setTimezone(new \DateTimeZone("UTC"));
        $string = $now->format(\System\DateTimeEx::ISO8601_DATETIME);

        // Act
        $dt = DateTimeEx::parse($string, DateTimeEx::ISO8601_DATETIME, DateTimeZoneEx::EUROPE_AMSTERDAM());

        // Assert
        $this->assertEquals("Europe/Amsterdam", $dt->getTimezone()->getName());
    }
}
