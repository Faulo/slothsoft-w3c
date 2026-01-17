<?php
declare(strict_types = 1);
namespace w3c;

use PHPUnit\Framework\TestCase;

/**
 * XMLHttpRequestEventTargetTest
 *
 * @see XMLHttpRequestEventTarget
 *
 * @todo auto-generated
 */
final class XMLHttpRequestEventTargetTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(XMLHttpRequestEventTarget::class), "Failed to load interface 'w3c\XMLHttpRequestEventTarget'!");
    }
}