<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * EntityTest
 *
 * @see Entity
 *
 * @todo auto-generated
 */
final class EntityTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Entity::class), "Failed to load interface 'w3c\dom\Entity'!");
    }
}