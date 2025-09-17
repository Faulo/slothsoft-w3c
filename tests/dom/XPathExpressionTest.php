<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * XPathExpressionTest
 *
 * @see XPathExpression
 *
 * @todo auto-generated
 */
class XPathExpressionTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(XPathExpression::class), "Failed to load interface 'w3c\dom\XPathExpression'!");
    }
}