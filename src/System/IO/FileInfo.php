<?php

namespace System\IO;

final class FileInfo
{
    /**
     * properties
     */
    private $originalPath;
    private $fullPath;

    /**
     * attributes
     */
    public function getOriginalPath(): string
    {
        return $this->originalPath;
    }

    public function getFullPath(): string
    {
        return $this->fullPath;
    }

    public function getExists(): bool
    {
        return file_exists($this->fullPath);
    }

    public function getLength(): int
    {
        if (!$this->getExists()) {
            throw new \Exception("FileNotFoundException - The file does not exist.");
        }
        return filesize($this->fullPath);
    }

    public function getName(): string
    {
        $start = strrpos($this->fullPath, DIRECTORY_SEPARATOR) + 1;
        $end = strrpos($this->fullPath, '.') - $start;
        return substr($this->fullPath, $start, $end);
    }

    public function getFullName(): string
    {
        return substr($this->fullPath, strrpos($this->fullPath, DIRECTORY_SEPARATOR) + 1, strlen($this->fullPath));
    }

    public function getExtension(): string
    {
        return substr($this->fullPath, strrpos($this->fullPath, '.') + 1, strlen($this->fullPath));
    }

    public function getDirectoryName(): string
    {
        return substr($this->fullPath, 0, strrpos($this->fullPath, DIRECTORY_SEPARATOR));
    }

    public function getDirectory(): DirectoryInfo
    {
        return new DirectoryInfo($this->getDirectoryName());
    }

    /**
     * constructor
     */
    public function __construct(string $filename)
    {
        if (empty($filename)) {
            // or contains white spaces...
            // also check for invalid characters
            throw new \Exception("ArgumentException - The file name is empty, contains only white spaces, or contains invalid characters.");
        }

        if (false) {
            throw new \Exception("NotSupportedException - fileName contains a colon (:) in the middle of the string.");
        }

        $filename = rtrim($filename, DIRECTORY_SEPARATOR);

        $this->originalPath = $filename;

        // todo, fix relative paths
        if ($this->isAbsolutePath($filename)) {
            $this->fullPath = $filename;
        } else {
            $this->fullPath = \getcwd() . DIRECTORY_SEPARATOR . $filename;
        }
    }

    // helper(s)
    private function isAbsolutePath(string $path)
    {
        if (!ctype_print($path)) {
            throw new \DomainException("Path can NOT have non-printable characters or be empty.");
        }

        // Optional wrapper(s).
        $regExp = '%^(?<wrappers>(?:[[:print:]]{2,}://)*)';
        // Optional root prefix.
        $regExp .= '(?<root>(?:[[:alpha:]]:[/\\\\]|/)?)';
        // Actual path.
        $regExp .= '(?<path>(?:[[:print:]]*))$%';

        $parts = [];
        if (!preg_match($regExp, $path, $parts)) {
            throw new \DomainException(sprintf('Path is NOT valid, was given %s', $path));
        }

        if ('' !== $parts['root']) {
            return true;
        }
        return false;
    }
}
