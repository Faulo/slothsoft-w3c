<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * DOMImplementationTest
 *
 * @see DOMImplementation
 *
 * @todo auto-generated
 */
class DOMImplementationTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(DOMImplementation::class), "Failed to load interface 'w3c\dom\DOMImplementation'!");
    }
}