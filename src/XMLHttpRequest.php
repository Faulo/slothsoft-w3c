<?php
declare(strict_types = 1);
namespace w3c;

/**
 * XMLHttpRequest
 *
 * @link https://www.w3.org/TR/XMLHttpRequest1/#the-xmlhttprequest-interface
 */
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
    
    /**
     * Sets the request method, request URL, asynchronous flag, request username, and request password.
     *
     * @param string $method
     * @param string $url
     * @param bool $async
     * @param string $user
     * @param string $password
     */
    public function open(string $method, string $url, bool $async = true, string $user = null, string $password = null): void;
    
    /**
     * Appends an header to the list of author request headers or if the header is already in the author request headers its value appended to.
     *
     * @param string $header
     * @param string $value
     */
    public function setRequestHeader(string $header, string $value): void;
    
    /**
     * Initiates the request.
     * The optional argument provides the request entity body. The argument is ignored if request method is GET or HEAD.
     *
     * @param mixed $data
     */
    public function send($data = null): void;
    
    /**
     * Cancels any network activity.
     */
    public function abort(): void;
    
    /**
     * Acts as if the `Content-Type` header value for a response is mime.
     * (It does not change the header.)
     *
     * @param string $mime
     */
    public function overrideMimeType(string $mime): void;
    
    /**
     * Returns the header field value from the response of which the field name matches header, unless the field name is Set-Cookie or Set-Cookie2.
     *
     * @param string $header
     * @return string
     */
    public function getResponseHeader(string $header): string;
    
    /**
     * Returns all headers from the response, with the exception of those whose field name is Set-Cookie or Set-Cookie2.
     *
     * @return array
     */
    public function getAllResponseHeaders(): array;
}