<?php
declare(strict_types=1);

namespace w3c\Internal;

use PHPUnit\Framework\TestCase;
use ReflectionProperty;

/**
 * InterfaceGeneratorTest
 *
 * @see InterfaceGenerator
 */
final class InterfaceGeneratorTest extends TestCase
{

    /**
     *
     * @test
     */
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(InterfaceGenerator::class), "Failed to load class 'w3c\Internal\InterfaceGenerator'!");
    }

    /**
     * @runInSeparateProcess
     */
    public function testGeneratesInterfacesWithParentsAndTypeImports(): void
    {
        $directory = tempnam(sys_get_temp_dir(), 'w3c-interfaces-');
        self::assertNotFalse($directory);
        unlink($directory);
        mkdir($directory);

        try {
            $module = new InterfaceModule('', __DIR__ . '/../../test-files/interfaces.html');
            $generator = new InterfaceGenerator($module);
            $path = new ReflectionProperty(InterfaceGenerator::class, 'interfacePath');
            if (PHP_VERSION_ID < 80100) {
                $path->setAccessible(true);
            }
            $path->setValue($generator, $directory . DIRECTORY_SEPARATOR);

            $this->expectOutputRegex('/Creating Interface/');
            $generator->writeInterfaces();

            $plain = file_get_contents($directory . '/Plain.php');
            self::assertNotFalse($plain);
            self::assertStringContainsString('interface Plain {', $plain);
            self::assertStringContainsString('public function reset(): void;', $plain);

            $inherited = file_get_contents($directory . '/Inherited.php');
            self::assertNotFalse($inherited);
            self::assertStringContainsString('use DOMDocument;', $inherited);
            self::assertStringContainsString('use w3c\\dom\\Event;', $inherited);
            self::assertStringContainsString('interface Inherited extends Event {', $inherited);
            self::assertStringContainsString('public function load(DOMDocument $document): DOMDocument;', $inherited);
            self::assertSame(1, substr_count($inherited, 'use DOMDocument;'));
        } finally {
            foreach (['Plain', 'Inherited'] as $name) {
                $file = $directory . '/' . $name . '.php';
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($directory);
        }
    }
}
