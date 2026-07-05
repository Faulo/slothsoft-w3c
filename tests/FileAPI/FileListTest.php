<?php
declare(strict_types = 1);

namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * FileListTest
 *
 * @see FileList
 *
 * @todo auto-generated
 */
final class FileListTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(FileList::class), "Failed to load interface 'w3c\FileAPI\FileList'!");
    }
}