<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * NotationTest
 *
 * @see Notation
 *
 * @todo auto-generated
 */
class NotationTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Notation::class), "Failed to load interface 'w3c\dom\Notation'!");
    }
}