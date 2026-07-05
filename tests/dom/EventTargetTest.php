<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * EventTargetTest
 *
 * @see EventTarget
 *
 * @todo auto-generated
 */
final class EventTargetTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(EventTarget::class), "Failed to load interface 'w3c\dom\EventTarget'!");
    }
}