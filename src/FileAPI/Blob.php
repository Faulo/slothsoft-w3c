<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 *
 * @see https://www.w3.org/TR/FileAPI/#dfn-Blob
 */
interface Blob {

    /**
     * Returns the size of the byte sequence in number of bytes.
     *
     * @return int
     * @see https://www.w3.org/TR/FileAPI/#dfn-size
     */
    public function getSize(): int;

    /**
     * The ASCII-encoded string in lower case representing the media type of the Blob.
     *
     * @return string
     * @see https://www.w3.org/TR/FileAPI/#dfn-type
     */
    public function getType(): string;

    /**
     * The slice() method returns a new Blob object with bytes ranging from the optional start parameter up to but not including the optional end parameter, and with a type attribute that is the value of the optional contentType parameter.
     *
     * @param int $start
     * @param int $end
     * @param string $contentType
     * @return Blob
     * @see https://www.w3.org/TR/FileAPI/#dfn-slice
     */
    public function slice(int $start = null, int $end = null, string $contentType = null): Blob;
}
