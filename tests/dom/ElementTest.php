<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * ElementTest
 *
 * @see Element
 *
 * @todo auto-generated
 */
final class ElementTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Element::class), "Failed to load interface 'w3c\dom\Element'!");
    }
}