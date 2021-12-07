<?php

namespace System\Test;

use PHPUnit\Framework\TestCase;
use System\Enum;

class State extends Enum
{
    const STARTED = 'STARTED';
    const PUTONHOLD = 'PUTONHOLD';
    const INPROGRESS = 'INPROGRESS';
}

class StateWithValues extends Enum
{
    const STARTED = '1';
    const PUTONHOLD = '2';
    const INPROGRESS = '3';
}

/**
 * @group System
 * @group System.Enum
 */
class EnumTest extends TestCase
{
    public function testConstructorWithExistingValue()
    {
        // Arrange & Act
        $state = new State("STARTED");

        // Assert
        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testConstructorWithExistingValueButWithWrongCase()
    {
        // Arrange & Act
        $state = new State("sTaRtEd", true);

        // Assert
        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testConstructorWithExistingValueButWithWrongCaseStrictChecking()
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('value is outside the range of the underlying type of enumType.');

        // Act
        new State("sTaRtEd");
    }

    public function testTryParseWithExistingValue()
    {
        $state = null;
        $result = State::tryParse("STARTED", $state);

        $this->assertEquals(true, $result);
        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testTryParseWithExistingValueButWithWrongCase()
    {
        $state = null;
        $result = State::tryParse("sTaRtEd", $state, true);

        $this->assertEquals(true, $result);
        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testTryParseWithNonExistingValue()
    {
        $state = null;
        $result = State::tryParse("STOPPED", $state);

        $this->assertEquals(false, $result);
    }

    public function testParseWithExistingValue()
    {
        $state = State::parse("STARTED");

        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testParseWithNonExistingValue()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('value is outside the range of the underlying type of enumType.');

        State::parse("STOPPED");
    }

    public function testCallStatic()
    {
        $state = State::STARTED();

        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testCallStaticWithValues()
    {
        $state = StateWithValues::STARTED();

        $this->assertEquals(StateWithValues::class, get_class($state));
        $this->assertEquals("STARTED", $state->getKey());
        $this->assertEquals(StateWithValues::STARTED, $state->getValue());
    }

    public function testCallStaticWithNonExistingValue()
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('value is outside the range of the underlying type of enumType.');

        $state = State::STOPPED();

        $this->assertEquals(State::class, get_class($state));
        $this->assertEquals("STARTED", $state->getValue());
    }

    public function testToStringMethod()
    {
        // Assert
        $state = State::STARTED();

        // Assert
        $this->assertEquals("STARTED", (string) $state);
    }
}
