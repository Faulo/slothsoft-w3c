<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * AttrTest
 *
 * @see Attr
 *
 * @todo auto-generated
 */
class AttrTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Attr::class), "Failed to load interface 'w3c\dom\Attr'!");
    }
}