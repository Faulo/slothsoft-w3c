<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * URLTest
 *
 * @see URL
 *
 * @todo auto-generated
 */
class URLTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(URL::class), "Failed to load interface 'w3c\FileAPI\URL'!");
    }
}