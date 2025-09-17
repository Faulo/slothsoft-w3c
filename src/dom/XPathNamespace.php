<?php
declare(strict_types = 1);
/**
 * XPathNamespace
 */
namespace w3c\dom;

interface XPathNamespace extends Node {
    
    const XPATH_NAMESPACE_NODE = 13;
    
    /**
     *
     * @return Element
     */
    public function getOwnerElement(): Element;
}