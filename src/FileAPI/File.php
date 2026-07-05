<?php
declare(strict_types = 1);
namespace w3c\FileAPI;
use DateTimeInterface;

/**
 * File
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#dfn-file
 */

interface File extends Blob {

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return DateTimeInterface
     */
    public function getLastModifiedDate(): DateTimeInterface;
}
