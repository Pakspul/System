<?php 

namespace System\IO;

final class FileEx
{
    private function __construct()
    {
        // sealed class...
    }
    
    // hier kan ook create, open etc komen...

    public static function copy(string $sourceFileName, string $destFileName, bool $overwrite = false)
    {
        $sourceFi = new FileInfo($sourceFileName);
        $destFi = new FileInfo($destFileName);

        if (!$sourceFi->getExists()) {
            throw new \Exception("FileNotFoundException - sourceFileName was not found.");
        }

        if (!$destFi->getDirectory()->getExists()) {
            throw new \Exception("DirectoryNotFoundException - The path specified in sourceFileName or destFileName is invalid (for example, it is on an unmapped drive).");
        }

        if ($destFi->getExists() && !$overwrite) {
            throw new \Exception("IOException - destFileName exists and overwrite is false.");
        }

        if (!copy($sourceFileName, $destFileName)) {
            throw new \Exception("IOException - An I/O error has occurred.");
        }
    }
}