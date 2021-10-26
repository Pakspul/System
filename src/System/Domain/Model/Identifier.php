<?php

namespace System\Domain\Model;

use System\Guid;

abstract class Identifier extends ValueObject
{
    /**
     * @param Guid
     * @return static
     */
    final public static function createNew()
    {
        return static::create(Guid::newGuid());
    }

    /**
     * @param Guid
     * @return static
     */
    final public static function create(Guid $id)
    {
        if (Guid::isEmpty($id)) {
            throw new \Exception("Guid may not be empty.");
        }

        return new static($id);
    }

    /**
     * @param string
     * @return static
     */
    final public static function createFromString(string $guid)
    {
        $id = null;
        if (!Guid::tryParse($guid, $id)) {
            throw new \Exception("Input is not in a recognized GUID format.");
        }

        return self::create($id);
    }

    /**
     * @var Guid
     */
    private $value;

    private function __construct(Guid $id)
    {
        $this->value = $id;
    }

    /**
     * @return Guid
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function equals(Identifier $other)
    {
        return ($this->value->equals($other->getValue()));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value->__toString();
    }
}
