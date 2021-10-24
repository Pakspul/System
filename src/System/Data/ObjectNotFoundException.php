<?php

namespace System\Data;

class ObjectNotFoundException extends \Exception
{
    private const DEFAULT_MESSAGE = "No result was found for query although at least one row was expected.";
    private const DEFAULT_OBJECT_AND_ID_MESSAGE = "No record found for entity '%s' with id '%s'.";
    private const DEFAULT_OBJECT_MESSAGE = "No record found for entity '%s'.";

    public function __construct(string $object = null, string $id = null, \Exception $innerException = null)
    {
        if ($object !== null && $id !== null) {
            parent::__construct(sprintf(self::DEFAULT_OBJECT_AND_ID_MESSAGE, $object, $id), 0, $innerException);
        } else if ($object !== null && $id === null) {
            parent::__construct(sprintf(self::DEFAULT_OBJECT_MESSAGE, $object), 0, $innerException);
        } else {
            parent::__construct(self::DEFAULT_MESSAGE, 0, $innerException);
        }
    }
}
