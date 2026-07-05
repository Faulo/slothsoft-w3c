<?php
declare(strict_types = 1);
use w3c\Internal\InterfaceGenerator;
use w3c\Internal\InterfaceModule;

require_once __DIR__ . '/../vendor/autoload.php';

$modules = [];
//$modules[] = new InterfaceModule('dom', 'https://www.w3.org/TR/2004/REC-DOM-Level-3-Core-20040407/core.html');
$modules[] = new InterfaceModule('dom', 'https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html');
//$modules[] = new InterfaceModule('dom', 'https://www.w3.org/TR/2004/NOTE-DOM-Level-3-XPath-20040226/xpath.html');
$modules[] = new InterfaceModule('FileAPI', 'https://www.w3.org/TR/2011/WD-FileAPI-20111020/', true);
$modules[] = new InterfaceModule('', 'https://www.w3.org/TR/2012/WD-XMLHttpRequest-20120117/');

foreach ($modules as $module) {
    $generator = new InterfaceGenerator($module);
    $generator->writeInterfaces();
}
