<?php
declare(strict_types = 1);
namespace w3c;

interface XMLHttpRequest extends XMLHttpRequestEventTarget {

    // states
    const UNSENT = 0;

    const OPENED = 1;

    const HEADERS_RECEIVED = 2;

    const LOADING = 3;

    const DONE = 4;

    /*
     * public $onreadystatechange;
     * public $readyState = self::UNSENT;
     * public $timeout;
     * public $withCredentials;
     * public $upload;
     * public $status = 0;
     * public $statusText = '';
     * public $responseType;
     * public $response;
     * public $responseText;
     * public $responseXML;
     */
    public function open(string $method, string $url, bool $async = true, string $user = null, string $password = null): void;

    public function setRequestHeader(string $header, string $value): void;

    public function send($data = null): void;

    public function abort(): void;

    public function overrideMimeType(string $mime): void;

    public function getResponseHeader(string $header): string;

    public function getAllResponseHeaders(): array;
}