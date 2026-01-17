<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * CommentTest
 *
 * @see Comment
 *
 * @todo auto-generated
 */
final class CommentTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(Comment::class), "Failed to load interface 'w3c\dom\Comment'!");
    }
}