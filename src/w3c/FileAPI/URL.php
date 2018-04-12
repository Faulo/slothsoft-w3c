<?php
namespace w3c\FileAPI;

/**
 * @link https://www.w3.org/TR/FileAPI/#url
 *
 */
interface URL
{
    
    /**
     * The createObjectURL(blob) static method must return the result of adding an entry to the blob URL store for blob.
     *
     * @param resource $blob
     * @return string
     */
    public static function createObjectURL($blob): string;
    
    /**
     * The revokeObjectURL(url) static method must run these steps:
     *  1. Let url record be the result of parsing url.
     *  2. If url record’s scheme is not "blob", return.
     *  3. Let origin be the result of resolving the origin of url record.
     *  4. Let settings be the current settings object.
     *  5. If origin is not same origin with settings’s origin, return.
     *  6. Remove an entry from the Blob URL Store for url.
     *
     * @param string $url
     * @return void
     */
    public static function revokeObjectURL(string $url);
}

