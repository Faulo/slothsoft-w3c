<?php
declare(strict_types = 1);
namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * XMLHttpRequestTest
 *
 * @see XMLHttpRequest
 *
 * @todo auto-generated
 */
class XMLHttpRequestTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(XMLHttpRequest::class), "Failed to load interface 'w3c\XMLHttpRequest'!");
    }
}