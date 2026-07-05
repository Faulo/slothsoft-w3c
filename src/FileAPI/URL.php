<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 * URL
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#URL-object
 */

interface URL {

    /**
     * @param Blob $blob
     * @return string
     */
    public static function createObjectURL(Blob $blob): string;

    /**
     * @param string $url
     * @return void
     */
    public static function revokeObjectURL(string $url): void;
}
