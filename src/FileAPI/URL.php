<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 * URL
 *
 * @link https://www.w3.org/TR/FileAPI/#url
 */
interface URL {

    /**
     * Returns a unique Blob URL.
     *
     * @param resource $blob
     * @return string
     * @see https://www.w3.org/TR/FileAPI/#dfn-createObjectURL
     */
    public static function createObjectURL($blob): string;

    /**
     * Revokes the Blob URL provided in the string url by removing the corresponding entry from the Blob URL Store.
     *
     * @param string $url
     * @return void
     * @see https://www.w3.org/TR/FileAPI/#dfn-revokeObjectURL
     */
    public static function revokeObjectURL(string $url);
}

