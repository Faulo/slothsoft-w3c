<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * DocumentEventTest
 *
 * @see DocumentEvent
 *
 * @todo auto-generated
 */
final class DocumentEventTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(DocumentEvent::class), "Failed to load interface 'w3c\dom\DocumentEvent'!");
    }
}