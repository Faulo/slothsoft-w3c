<?php
declare(strict_types = 1);

namespace w3c\Internal;

use PHPUnit\Framework\TestCase;

/**
 * InterfaceModuleTest
 *
 * @see InterfaceModule
 *
 * @todo auto-generated
 */
final class InterfaceModuleTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testClassExists(): void {
        $this->assertTrue(class_exists(InterfaceModule::class), "Failed to load class 'w3c\Internal\InterfaceModule'!");
    }
}