<?php
declare(strict_types = 1);

namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * XMLHttpRequestUploadTest
 *
 * @see XMLHttpRequestUpload
 *
 * @todo auto-generated
 */
final class XMLHttpRequestUploadTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(XMLHttpRequestUpload::class), "Failed to load interface 'w3c\XMLHttpRequestUpload'!");
    }
}