<?php
declare(strict_types = 1);
namespace w3c;
use DOMDocument;
use w3c\FileAPI\Blob;

/**
 * XMLHttpRequest
 *
 * @see https://www.w3.org/TR/2014/WD-XMLHttpRequest-20140130/#xmlhttprequest
 */

interface XMLHttpRequest extends XMLHttpRequestEventTarget {

    public const UNSENT = 0;

    public const OPENED = 1;

    public const HEADERS_RECEIVED = 2;

    public const LOADING = 3;

    public const DONE = 4;

    /**
     * @param string $method
     * @param string $url
     * @param ?bool $async
     * @param ?string $username
     * @param ?string $password
     * @return void
     */
    public function open(string $method, string $url, ?bool $async = null, ?string $username = null, ?string $password = null): void;

    /**
     * @param string $header
     * @param string $value
     * @return void
     */
    public function setRequestHeader(string $header, string $value): void;

    /**
     * @param object|Blob|DOMDocument|string|FormData|null $data
     * @return void
     */
    public function send($data = null): void;

    /**
     * @return void
     */
    public function abort(): void;

    /**
     * @param string $header
     * @return ?string
     */
    public function getResponseHeader(string $header): ?string;

    /**
     * @return string
     */
    public function getAllResponseHeaders(): string;

    /**
     * @param string $mime
     * @return void
     */
    public function overrideMimeType(string $mime): void;
}
