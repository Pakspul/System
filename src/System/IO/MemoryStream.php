<?php

namespace System\IO;

class MemoryStream extends Stream
{
    private $data;

    public function __construct()
    {
        $this->data = ""; // todo, empty string?
    }

    public function getLength()
    {
        return strlen($this->data);
    }

    public function read(int $length)
    {
        // echo $this->position;
        return substr($this->data, $this->position, $length);
    }

    // todo, van loc een enum maken
    public function seek(int $offset, $loc = 0)
    {
        // check data length
        // check begin + negative

        // depending on LOC!
        $this->position = $offset;
        return;
    }

    public function write(string $data, int $length = null)
    {
        // TODO, do something with length?
        // todo, iets doen met de position?
        $this->data .= $data;
    } 
}