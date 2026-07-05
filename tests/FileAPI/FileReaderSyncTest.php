<?php
declare(strict_types = 1);

namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * FileReaderSyncTest
 *
 * @see FileReaderSync
 *
 * @todo auto-generated
 */
final class FileReaderSyncTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(FileReaderSync::class), "Failed to load interface 'w3c\FileAPI\FileReaderSync'!");
    }
}