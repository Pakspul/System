<?php

namespace System\IO;

abstract class Stream
{
    protected $position = 0;

    public function copyTo(Stream $stream)
    {
        return $stream->write($this->read($this->getLength())); 
    }

    abstract function getLength();

    abstract function read(int $length);
    
    abstract function write(string $data, int $length = null);

    // abstract function Seek(int $offset, System.IO.SeekOrigin loc);
    abstract function seek(int $offset, $loc = 0);
}
