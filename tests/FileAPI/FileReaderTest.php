<?php
declare(strict_types = 1);

namespace w3c\FileAPI;

use PHPUnit\Framework\TestCase;

/**
 * FileReaderTest
 *
 * @see FileReader
 *
 * @todo auto-generated
 */
final class FileReaderTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(FileReader::class), "Failed to load interface 'w3c\FileAPI\FileReader'!");
    }
}