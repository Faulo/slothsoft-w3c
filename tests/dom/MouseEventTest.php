<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * MouseEventTest
 *
 * @see MouseEvent
 *
 * @todo auto-generated
 */
final class MouseEventTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(MouseEvent::class), "Failed to load interface 'w3c\dom\MouseEvent'!");
    }
}