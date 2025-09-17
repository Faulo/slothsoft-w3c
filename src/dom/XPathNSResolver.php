<?php
declare(strict_types = 1);
/**
 * XPathNSResolver
 */
namespace w3c\dom;

interface XPathNSResolver {
    
    /**
     *
     * @param string $prefix
     * @return string
     */
    public function lookupNamespaceURI(string $prefix): string;
}