<?php
declare(strict_types = 1);
namespace w3c;
use w3c\FileAPI\Blob;

/**
 * FormData
 *
 * @see https://www.w3.org/TR/2012/WD-XMLHttpRequest-20120117/#formdata
 */

interface FormData {

    /**
     * @param string $name
     * @param Blob|string $value
     * @param ?string $filename
     * @return void
     */
    public function append(string $name, $value, ?string $filename = null): void;
}
