<?php 

namespace System\IO;

final class DirectoryInfo
{
    private $originalPath;
    private $fullPath;

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
        return (is_dir($this->fullPath) && file_exists($this->fullPath));
    }

    public function getName(): string
    {
        return substr($this->fullPath, strrpos($this->fullPath, DIRECTORY_SEPARATOR) + 1, strlen($this->fullPath));
    }

    public function getParent(): DirectoryInfo
    {
        $path = substr($this->fullPath, 0, strrpos($this->fullPath, DIRECTORY_SEPARATOR));
        return new DirectoryInfo($path);
    }

    public function __construct(string $path)
    {
        if (empty($path)) {
            // or contains white spaces...
            // also check for invalid characters
            throw new \Exception("ArgumentException - The file name is empty, contains only white spaces, or contains invalid characters.");
        }

        if (false) {
            throw new \Exception("NotSupportedException - path contains invalid characters such as \", <, >, or |.");
        }

        $this->originalPath = $path;

        // todo, fix relative paths
        if($this->isAbsolutePath($path)) {
            $this->fullPath = $path;
        } else {
            $this->fullPath = \getcwd() . DIRECTORY_SEPERATOR . $path;
        }
    }

    // helper(s)
    private function isAbsolutePath(string $path) {
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
