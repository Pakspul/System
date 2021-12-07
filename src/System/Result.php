<?php

namespace System;

// https://github.com/vkhorikov/CSharpFunctionalExtensions
class Result
{
    private $isFailure;
    private $errorKey;
    private $errorMessage;

    public function isSuccess(): bool
    {
        return !$this->isFailure;
    }

    public function isFailure(): bool
    {
        return $this->isFailure;
    }

    public function getErrorKey(): string
    {
        return $this->errorKey;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function __construct(bool $isFailure, string $errorKey = null, string $errorMessage = null)
    {
        if ($isFailure && (empty($errorKey) || empty($errorMessage))) {
            throw new \Exception("Both key and message need to be given.");
        }

        $this->isFailure = $isFailure;
        $this->errorKey = $errorKey;
        $this->errorMessage = $errorMessage;
    }

    public static function Failure(string $errorKey, string $errorMessage)
    {
        return new Result(true, $errorKey, $errorMessage);
    }

    public static function Success()
    {
        return new Result(false);
    }
}
