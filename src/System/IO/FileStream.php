<?php

namespace System\IO;

class FileStream extends Stream
{
    private $path;
    private $resource;
    private $fi;

    public function getLength()
    {
        return $this->fi->getLength();
    }
    
    public function __construct(string $path, FileMode $mode)
    {
        $this->path = $path;
        $this->fi = new FileInfo($path);

        // FileNotFoundException
        // The file cannot be found, such as when mode is FileMode.Truncate or FileMode.Open, and the file specified by path does not exist. The file must already exist in these modes.
        if ($mode === "open" && !$this->fi->getExists()) {
            throw new \Exception("FileNotFoundException - The file cannot be found, such as when mode is FileMode.Truncate or FileMode.Open, and the file specified by path does not exist. The file must already exist in these modes.");
        }

        $innerMode = null;
        switch($mode) {
            case FileMode::OPEN(): $innerMode = "r"; break;
            case FileMode::CREATE(): $innerMode = "w"; break;
            default: throw new \Exception();
        }
        

        $result = \fopen($path, $innerMode);
        if (!$result) {
            throw new \Exception("IOException, something wnet wong");
        }

        $this->resource = $result;
    }

    public function read(int $length): string
    {
        // echo $length;
        return fread($this->resource, $length);
    }

    public function write(string $data, int $length = null)
    {
        // todo, iets doen met de position?
        fwrite($this->resource, $data, $length);
    }

    public function seek(int $offset, $loc = 0)
    {
        fseek($this->resource, $offset);
    }

    public function __destruct()
    {
        fclose($this->resource);
    }
}
