<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 * Blob
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#dfn-Blob
 */

interface Blob {

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param ?int $start
     * @param ?int $end
     * @param ?string $contentType
     * @return Blob
     */
    public function slice(?int $start = null, ?int $end = null, ?string $contentType = null): Blob;
}
