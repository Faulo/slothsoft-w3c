<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * DOMConfigurationTest
 *
 * @see DOMConfiguration
 *
 * @todo auto-generated
 */
class DOMConfigurationTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(DOMConfiguration::class), "Failed to load interface 'w3c\dom\DOMConfiguration'!");
    }
}