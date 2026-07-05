<?php
declare(strict_types = 1);

namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * FormDataTest
 *
 * @see FormData
 *
 * @todo auto-generated
 */
final class FormDataTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(FormData::class), "Failed to load interface 'w3c\FormData'!");
    }
}