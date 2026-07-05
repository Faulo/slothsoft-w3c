<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

/**
 * FileList
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#dfn-filelist
 */

interface FileList {

    /**
     * @param int $index
     * @return ?File
     */
    public function item(int $index): ?File;

    /**
     * @return int
     */
    public function getLength(): int;
}
