<?php

namespace System\Domain;

use System\Guid;

abstract class Event
{
    private $Id;
    private $Version;

    public function __construct($id = null)
    {
        if ($id === null) {
            $id = (string) Guid::newGuid();
        }
        $this->Id = $id;
    }

    public function getId()
    {
        return $this->Id;
    }

    public function setVersion(int $version)
    {
        $this->Version = $version;
    }

    public function getVersion()
    {
        return $this->Version;
    }

    final public function toArray()
    {
        $outputArray = $this->objectToArray($this);
        return $outputArray;
    }

    private function objectToArray($object)
    {
        $reflect = new \ReflectionClass($object);
        $properties = $reflect->getProperties();

        if (empty($properties)) {
            return null;
        }

        $outputArray = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($object);
            if (is_object($value)) {
                $outputArray[$property->name] = $this->objectToArray($value);
            } else {
                $outputArray[$property->name] = $property->getValue($object); //todo, hier moet $value?
            }
        }
        return $outputArray;
    }
}
