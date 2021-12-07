<?php

namespace System\Domain\Exception;

use System\Result;

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

    public static function createFromResult(Result $result): DomainException
    {
        return new DomainException($result->getErrorKey(), $result->getErrorMessage());
    }
}
