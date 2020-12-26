<?php
declare(strict_types = 1);
use w3c\InterfaceGenerator;
use w3c\InterfaceModule;

require_once __DIR__ . '/../vendor/autoload.php';

$modules = [];
$modules[] = new InterfaceModule('dom', realpath('dom.core.html'), __DIR__, 'Test');
$modules[] = new InterfaceModule('dom', realpath('dom.xpath.html'), __DIR__, 'Test');

foreach ($modules as $module) {
    $generator = new InterfaceGenerator($module);
    $generator->writeInterfaces();
}
