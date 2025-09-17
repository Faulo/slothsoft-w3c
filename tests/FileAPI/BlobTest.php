<?php
declare(strict_types = 1);
namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * BlobTest
 *
 * @see Blob
 *
 * @todo auto-generated
 */
class BlobTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Blob::class), "Failed to load interface 'w3c\FileAPI\Blob'!");
    }
}