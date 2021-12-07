<?php

declare (strict_types = 1);

namespace tests\Domain;

use PHPUnit\Framework\TestCase;
use System\Domain\Exception\DomainException;
use System\Domain\Model\Integer;

final class IntegerTest extends TestCase
{
    public function testIntegerValueIsAnInteger()
    {
        // Arrange
        $value = 1;

        // Act
        $result = Integer::tryCreate($value);

        // Assert
        $this->assertTrue($result->isSuccess());
    }

    public function testNumberIsNotAnInteger()
    {
        // Arrange
        $value = 1.2;

        // Act
        $result = Integer::tryCreate($value);

        // Assert
        $this->assertTrue($result->isFailure());
    }

    public function testCreateMethodWithValidIntegerReturnInstance()
    {
        // Arrange
        $value = 1;

        // Act
        $integer = Integer::create($value);

        // Assert
        $this->assertEquals($value, $integer->getValue());
    }

    public function testCreateMethodWithInvalidIntegerThrowsException()
    {
        // Assert
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Value is not a valid integer.");

        // Arrange
        $value = 1.2;

        // Act
        Integer::create($value);
    }

    public function testEqualsWithSameIntegerValue()
    {
        // Arrenge
        $int1 = Integer::create(123);
        $int2 = Integer::create(123);

        // Act
        $result = $int1->equals($int2);

        // Assert
        $this->assertTrue($result);
    }

    public function testNotEqualWithDiffertIntegerValue()
    {
        // Arrenge
        $int1 = Integer::create(123);
        $int2 = Integer::create(321);

        // Act
        $result = $int1->equals($int2);

        // Assert
        $this->assertFalse($result);
    }

    public function testToStringMethod()
    {
        // Arrange
        $value = 123;

        // Act
        $integer = Integer::create($value);

        // Assert
        $this->assertEquals((string) $value, (string) $integer);
    }
}
