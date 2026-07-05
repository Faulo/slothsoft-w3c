<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 * FileReaderSync
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#dfn-FileReaderSync
 */

interface FileReaderSync {

    /**
     * @param Blob $blob
     * @return object
     */
    public function readAsArrayBuffer(Blob $blob): object;

    /**
     * @param Blob $blob
     * @return string
     */
    public function readAsBinaryString(Blob $blob): string;

    /**
     * @param Blob $blob
     * @param ?string $encoding
     * @return string
     */
    public function readAsText(Blob $blob, ?string $encoding = null): string;

    /**
     * @param Blob $blob
     * @return string
     */
    public function readAsDataURL(Blob $blob): string;
}
