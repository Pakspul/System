<?php

namespace System\IO;

/**
 * https://github.com/damianh/StaticFilesMiddleware/blob/master/src/Microsoft.Owin.StaticFiles/ContentTypes/FileExtensionContentTypeProvider.cs
 */
final class FileExtensionContentTypeProvider
{
    private $mappings = [
        'gif' => 'image/gif',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
    ];

    public function tryGetContentType(string $extension, string &$contentType): bool
    {
        if (!isset($this->mappings[$extension])) {
            return false;
        }

        $contentType = $this->mappings[$extension];

        return true;
    }
}