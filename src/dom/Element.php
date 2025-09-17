<?php
declare(strict_types = 1);
/**
 * Element
 */
namespace w3c\dom;

interface Element extends Node {
    
    /**
     *
     * @return string
     */
    public function getTagName(): string;
    
    /**
     *
     * @return TypeInfo
     */
    public function getSchemaTypeInfo(): TypeInfo;
    
    /**
     *
     * @param string $name
     * @return string
     */
    public function getAttribute(string $name): string;
    
    /**
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setAttribute(string $name, string $value): void;
    
    /**
     *
     * @param string $name
     * @return void
     */
    public function removeAttribute(string $name): void;
    
    /**
     *
     * @param string $name
     * @return Attr
     */
    public function getAttributeNode(string $name): Attr;
    
    /**
     *
     * @param Attr $newAttr
     * @return Attr
     */
    public function setAttributeNode(Attr $newAttr): Attr;
    
    /**
     *
     * @param Attr $oldAttr
     * @return Attr
     */
    public function removeAttributeNode(Attr $oldAttr): Attr;
    
    /**
     *
     * @param string $name
     * @return array
     */
    public function getElementsByTagName(string $name): array;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return string
     */
    public function getAttributeNS(string $namespaceURI, string $localName): string;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $qualifiedName
     * @param string $value
     * @return void
     */
    public function setAttributeNS(string $namespaceURI, string $qualifiedName, string $value): void;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return void
     */
    public function removeAttributeNS(string $namespaceURI, string $localName): void;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return Attr
     */
    public function getAttributeNodeNS(string $namespaceURI, string $localName): Attr;
    
    /**
     *
     * @param Attr $newAttr
     * @return Attr
     */
    public function setAttributeNodeNS(Attr $newAttr): Attr;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return array
     */
    public function getElementsByTagNameNS(string $namespaceURI, string $localName): array;
    
    /**
     *
     * @param string $name
     * @return bool
     */
    public function hasAttribute(string $name): bool;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return bool
     */
    public function hasAttributeNS(string $namespaceURI, string $localName): bool;
    
    /**
     *
     * @param string $name
     * @param bool $isId
     * @return void
     */
    public function setIdAttribute(string $name, bool $isId): void;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @param bool $isId
     * @return void
     */
    public function setIdAttributeNS(string $namespaceURI, string $localName, bool $isId): void;
    
    /**
     *
     * @param Attr $idAttr
     * @param bool $isId
     * @return void
     */
    public function setIdAttributeNode(Attr $idAttr, bool $isId): void;
}