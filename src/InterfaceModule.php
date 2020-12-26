<?php
declare(strict_types = 1);
namespace w3c;

class InterfaceModule {

    public $moduleName;

    public $interfaceURI;

    public $classDirectory;

    public $classNS;

    public function __construct(string $moduleName, string $interfaceURI, string $classDirectory, string $classNS = '') {
        assert(is_dir($classDirectory));
        $this->moduleName = $moduleName;
        $this->interfaceURI = $interfaceURI;
        $this->classDirectory = $classDirectory;
        $this->classNS = $classNS;
    }
}