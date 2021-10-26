<?php

namespace System\Domain\Model;

abstract class Entity
{
    /**
     * @var Identifier
     */
    protected $id;

    protected function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    /**
     * @return Identifier
     */
    public function getId()
    {
        return $this->id;
    }
}
