<?php

namespace System\Domain\Exception;

class DomainException extends \Exception
{
    private $key;

    public function __construct(string $key, string $message)
    {
        parent::__construct($message);

        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
