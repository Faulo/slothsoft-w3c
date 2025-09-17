<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * DocumentTest
 *
 * @see Document
 *
 * @todo auto-generated
 */
class DocumentTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Document::class), "Failed to load interface 'w3c\dom\Document'!");
    }
}