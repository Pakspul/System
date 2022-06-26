<?php

namespace System\Drawing;

use System\IO\Stream;
use System\IO\MemoryStream;

class Image
{
    private $resource;

    public function __construct(Stream $stream)
    {
        $this->resource = \imagecreatefromstring($stream->read($stream->getLength()));
        if (!$this->resource) {
            throw new \Exception("An error occurred.");
        }

        $this->width = imagesx($this->resource);
        $this->height = imagesy($this->resource);
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function resize(int $width, int $height): Image
    {
        $newresource = imagecreatetruecolor($width, $height);
        imagecopyresampled($newresource, $this->resource, 0, 0, 0, 0, $width, $height, $this->width, $this->height);

        $ms = new MemoryStream();
        $ms->write($this->convertResourceToString($newresource));
        return new Image($ms);
    }

    public function crop(int $x, int $y, int $width, int $height): Image
    {
        // $newresource = imagecreatetruecolor($width, $height);
        $newresource = imagecrop($this->resource, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);

        $ms = new MemoryStream();
        $ms->write($this->convertResourceToString($newresource));
        return new Image($ms);
    }

    // todo, uitbreiden met mogelijkheid om output format, of FileFormat aan te geven
    // kan middels een Enum
    public function save(Stream $stream): void
    {
        $content = $this->convertResourceToString($this->resource);

        $stream->write($content, strlen($content));
    }

    // private helper(s)
    private function convertResourceToString($resource): string
    {
        ob_start();
        $result = imagepng($resource);
        
        if (!$result) {
            // first ob_get_clean
            ob_get_clean();
            // then throw exception
            throw new \Exception();
        }

        return ob_get_clean();
    }
}