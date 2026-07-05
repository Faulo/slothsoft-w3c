<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * EventTest
 *
 * @see Event
 *
 * @todo auto-generated
 */
final class EventTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Event::class), "Failed to load interface 'w3c\dom\Event'!");
    }
}