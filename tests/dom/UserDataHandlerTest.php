<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

/**
 * UserDataHandlerTest
 *
 * @see UserDataHandler
 *
 * @todo auto-generated
 */
final class UserDataHandlerTest extends TestCase {
    
    public function testInterfaceExists(): void {
        $this->assertTrue(interface_exists(UserDataHandler::class), "Failed to load interface 'w3c\dom\UserDataHandler'!");
    }
}