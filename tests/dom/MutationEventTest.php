<?php
declare(strict_types = 1);

namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * MutationEventTest
 *
 * @see MutationEvent
 *
 * @todo auto-generated
 */
final class MutationEventTest extends TestCase {
    
    /**
     *
     * @test
     */
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(MutationEvent::class), "Failed to load interface 'w3c\dom\MutationEvent'!");
    }
}