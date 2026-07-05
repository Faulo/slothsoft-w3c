<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * UIEventTest
 *
 * @see UIEvent
 *
 * @todo auto-generated
 */
final class UIEventTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(UIEvent::class), "Failed to load interface 'w3c\dom\UIEvent'!");
    }
}