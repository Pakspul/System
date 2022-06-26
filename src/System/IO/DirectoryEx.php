<?php

namespace System\IO;

final class DirectoryEx
{
    private function __construct()
    {
        // sealed class...
    }

    public static function create(string $directory, int $permissions = 0777, bool $recursive = false): void
    {
        if (false) {
            throw new \Exception("ArgumentException - path is a zero-length string, contains only white space, or contains one or more invalid characters.");
        }

        $di = new DirectoryInfo($directory);
        if ($di->getExists()) {
            return;
        }

        $result = \mkdir($directory, $permissions, $recursive);
        if (!$result) {
            throw new \Exception("The directory cannot be created.");
        }
    }
}