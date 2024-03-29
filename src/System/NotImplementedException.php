<?php

namespace System;

class NotImplementedException extends \Exception
{
    public function __construct($message = null)
    {
        $message = $message ?? 'The method or operation is not implemented';

        parent::__construct($message);
    }
}
