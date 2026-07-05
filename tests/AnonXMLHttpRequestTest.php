<?php
declare(strict_types = 1);

namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * AnonXMLHttpRequestTest
 *
 * @see AnonXMLHttpRequest
 *
 * @todo auto-generated
 */
final class AnonXMLHttpRequestTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(AnonXMLHttpRequest::class), "Failed to load interface 'w3c\AnonXMLHttpRequest'!");
    }
}