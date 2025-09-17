<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * TypeInfoTest
 *
 * @see TypeInfo
 *
 * @todo auto-generated
 */
class TypeInfoTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(TypeInfo::class), "Failed to load interface 'w3c\dom\TypeInfo'!");
    }
}