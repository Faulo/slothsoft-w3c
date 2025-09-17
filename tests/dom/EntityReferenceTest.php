<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * EntityReferenceTest
 *
 * @see EntityReference
 *
 * @todo auto-generated
 */
class EntityReferenceTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(EntityReference::class), "Failed to load interface 'w3c\dom\EntityReference'!");
    }
}