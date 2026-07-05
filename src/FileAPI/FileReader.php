<?php
declare(strict_types = 1);
namespace w3c\FileAPI;
use DOMException;
use w3c\dom\EventTarget;

/**
 * FileReader
 *
 * @see https://www.w3.org/TR/2011/WD-FileAPI-20111020/#dfn-filereader
 */

interface FileReader extends EventTarget {

    public const EMPTY = 0;

    public const LOADING = 1;

    public const DONE = 2;

    /**
     * @param Blob $blob
     * @return void
     */
    public function readAsArrayBuffer(Blob $blob): void;

    /**
     * @param Blob $blob
     * @return void
     */
    public function readAsBinaryString(Blob $blob): void;

    /**
     * @param Blob $blob
     * @param ?string $encoding
     * @return void
     */
    public function readAsText(Blob $blob, ?string $encoding = null): void;

    /**
     * @param Blob $blob
     * @return void
     */
    public function readAsDataURL(Blob $blob): void;

    /**
     * @return void
     */
    public function abort(): void;

    /**
     * @return int
     */
    public function getReadyState(): int;

    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @return DOMException
     */
    public function getError(): DOMException;

    /**
     * @return ?callable
     */
    public function getOnloadstart(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnloadstart(?callable $value): void;

    /**
     * @return ?callable
     */
    public function getOnprogress(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnprogress(?callable $value): void;

    /**
     * @return ?callable
     */
    public function getOnload(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnload(?callable $value): void;

    /**
     * @return ?callable
     */
    public function getOnabort(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnabort(?callable $value): void;

    /**
     * @return ?callable
     */
    public function getOnerror(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnerror(?callable $value): void;

    /**
     * @return ?callable
     */
    public function getOnloadend(): ?callable;

    /**
     * @param ?callable $value
     * @return void
     */
    public function setOnloadend(?callable $value): void;
}
