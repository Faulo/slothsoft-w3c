<?php
declare(strict_types = 1);

namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * FileTest
 *
 * @see File
 *
 * @todo auto-generated
 */
final class FileTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(File::class), "Failed to load interface 'w3c\FileAPI\File'!");
    }
}