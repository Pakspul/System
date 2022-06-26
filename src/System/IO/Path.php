<?php 

namespace System\IO;

final class Path
{
    public static function combine(array $paths): string
    {
        $output = array_shift($paths);

        foreach ($paths as $path)
        {
            $output = rtrim($output, "\\") . "\\" . rtrim($path, "\\");
        }

        return $output;
    }
}
