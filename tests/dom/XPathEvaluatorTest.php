<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * XPathEvaluatorTest
 *
 * @see XPathEvaluator
 *
 * @todo auto-generated
 */
final class XPathEvaluatorTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(XPathEvaluator::class), "Failed to load interface 'w3c\dom\XPathEvaluator'!");
    }
}