<?php
declare(strict_types = 1);

namespace w3c\Internal;

class InterfaceModule {
    
    public string $moduleName;
    
    public string $interfaceURI;
    
    public bool $generateAttributeAccessors;
    
    public function __construct(string $moduleName, string $interfaceURI, bool $generateAttributeAccessors = false) {
        $this->moduleName = $moduleName;
        $this->interfaceURI = $interfaceURI;
        $this->generateAttributeAccessors = $generateAttributeAccessors;
    }
}
