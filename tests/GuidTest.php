<?php

namespace System\Test;

use PHPUnit\Framework\TestCase;
use System\Guid;

/**
 * @group System
 * @group System.Guid
 */
class Guid_TryParse_Test extends TestCase
{
    public function testEqualsWithSameGuidValue()
    {
        // Arrenge
        $guid1 = new Guid("ABCD1234-0000-AAAA-0000-AAAAAAAAAAAA");
        $guid2 = new Guid("ABCD1234-0000-AAAA-0000-AAAAAAAAAAAA");

        // Act
        $result = $guid1->equals($guid2);

        // Assert
        $this->assertTrue($result);
    }

    public function testNotEqualWithDiffertGuidValue()
    {
        // Arrenge
        $guid1 = new Guid("ABCD1234-0000-AAAA-0000-AAAAAAAAAAAA");
        $guid2 = new Guid("ABCD1234-0000-AAAA-0000-BBBBBBBBBBBB");

        // Act
        $result = $guid1->equals($guid2);

        // Assert
        $this->assertFalse($result);
    }

    public function testTryParseWithValidFormat()
    {
        // Arrenge
        $value = "ABCD1234-0000-AAAA-0000-AAAAAAAAAAAA";

        // Act
        $result = Guid::tryParse($value);

        // Assert
        $this->assertTrue($result);
    }

    public function testTryParseWithInvalidFormat()
    {
        // Arrenge
        $value = "ABCD12340000AAAA0000AAAAAAAAAAAA";

        // Act
        $result = Guid::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testTryParseWithInvalidSeperators()
    {
        // Arrenge
        $value = "00000000+0000+0000+0000+000000000000";

        // Act
        $result = Guid::tryParse($value);

        // Assert
        $this->assertFalse($result);
    }

    public function testEmptyGuid()
    {
        // Arrenge & Act
        $value = Guid::empty();

        // Assert
        $this->assertEquals('00000000-0000-0000-0000-000000000000', (string) $value);
    }

    public function testEmptyGuidIsEmpty()
    {
        // Arrenge
        $guid = Guid::empty();

        // Act
        $result = Guid::isEmpty($guid);

        // Assert
        $this->assertTrue($result);
    }

    public function testNonEmptyGuidIsEmpty()
    {
        // Arrenge
        $guid = new Guid("ABCD1234-0000-AAAA-0000-AAAAAAAAAAAA");

        // Act
        $result = Guid::isEmpty($guid);

        // Assert
        $this->assertFalse($result);
    }
}
