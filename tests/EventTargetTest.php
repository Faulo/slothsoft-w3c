<?php
declare(strict_types = 1);
namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * EventTargetTest
 *
 * @see EventTarget
 *
 * @todo auto-generated
 */
class EventTargetTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(EventTarget::class), "Failed to load interface 'w3c\EventTarget'!");
    }
}