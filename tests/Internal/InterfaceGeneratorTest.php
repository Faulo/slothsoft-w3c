<?php
declare(strict_types = 1);

namespace w3c\Internal;

use PHPUnit\Framework\TestCase;

/**
 * InterfaceGeneratorTest
 *
 * @see InterfaceGenerator
 *
 * @todo auto-generated
 */
final class InterfaceGeneratorTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testClassExists(): void {
        $this->assertTrue(class_exists(InterfaceGenerator::class), "Failed to load class 'w3c\Internal\InterfaceGenerator'!");
    }
}