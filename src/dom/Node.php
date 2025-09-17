<?php
declare(strict_types = 1);
/**
 * Node
 */
namespace w3c\dom;

interface Node {
    
    const ELEMENT_NODE = 1;
    
    const ATTRIBUTE_NODE = 2;
    
    const TEXT_NODE = 3;
    
    const CDATA_SECTION_NODE = 4;
    
    const ENTITY_REFERENCE_NODE = 5;
    
    const ENTITY_NODE = 6;
    
    const PROCESSING_INSTRUCTION_NODE = 7;
    
    const COMMENT_NODE = 8;
    
    const DOCUMENT_NODE = 9;
    
    const DOCUMENT_TYPE_NODE = 10;
    
    const DOCUMENT_FRAGMENT_NODE = 11;
    
    const NOTATION_NODE = 12;
    
    const DOCUMENT_POSITION_DISCONNECTED = 0x01;
    
    const DOCUMENT_POSITION_PRECEDING = 0x02;
    
    const DOCUMENT_POSITION_FOLLOWING = 0x04;
    
    const DOCUMENT_POSITION_CONTAINS = 0x08;
    
    const DOCUMENT_POSITION_CONTAINED_BY = 0x10;
    
    const DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC = 0x20;
    
    /**
     *
     * @return string
     */
    public function getNodeName(): string;
    
    /**
     *
     * @return string
     */
    public function getNodeValue(): string;
    
    /**
     *
     * @param string $nodeValue
     * @return void
     */
    public function setNodeValue(string $nodeValue): void;
    
    /**
     *
     * @return int
     */
    public function getNodeType(): int;
    
    /**
     *
     * @return Node
     */
    public function getParentNode(): Node;
    
    /**
     *
     * @return array
     */
    public function getChildNodes(): array;
    
    /**
     *
     * @return Node
     */
    public function getFirstChild(): Node;
    
    /**
     *
     * @return Node
     */
    public function getLastChild(): Node;
    
    /**
     *
     * @return Node
     */
    public function getPreviousSibling(): Node;
    
    /**
     *
     * @return Node
     */
    public function getNextSibling(): Node;
    
    /**
     *
     * @return array
     */
    public function getAttributes(): array;
    
    /**
     *
     * @return Document
     */
    public function getOwnerDocument(): Document;
    
    /**
     *
     * @return string
     */
    public function getNamespaceURI(): string;
    
    /**
     *
     * @return string
     */
    public function getPrefix(): string;
    
    /**
     *
     * @param string $prefix
     * @return void
     */
    public function setPrefix(string $prefix): void;
    
    /**
     *
     * @return string
     */
    public function getLocalName(): string;
    
    /**
     *
     * @return string
     */
    public function getBaseURI(): string;
    
    /**
     *
     * @return string
     */
    public function getTextContent(): string;
    
    /**
     *
     * @param string $textContent
     * @return void
     */
    public function setTextContent(string $textContent): void;
    
    /**
     *
     * @param Node $newChild
     * @param Node $refChild
     * @return Node
     */
    public function insertBefore(Node $newChild, Node $refChild): Node;
    
    /**
     *
     * @param Node $newChild
     * @param Node $oldChild
     * @return Node
     */
    public function replaceChild(Node $newChild, Node $oldChild): Node;
    
    /**
     *
     * @param Node $oldChild
     * @return Node
     */
    public function removeChild(Node $oldChild): Node;
    
    /**
     *
     * @param Node $newChild
     * @return Node
     */
    public function appendChild(Node $newChild): Node;
    
    /**
     *
     * @return bool
     */
    public function hasChildNodes(): bool;
    
    /**
     *
     * @param bool $deep
     * @return Node
     */
    public function cloneNode(bool $deep): Node;
    
    /**
     *
     * @return void
     */
    public function normalize(): void;
    
    /**
     *
     * @param string $feature
     * @param string $version
     * @return bool
     */
    public function isSupported(string $feature, string $version): bool;
    
    /**
     *
     * @return bool
     */
    public function hasAttributes(): bool;
    
    /**
     *
     * @param Node $other
     * @return int
     */
    public function compareDocumentPosition(Node $other): int;
    
    /**
     *
     * @param Node $other
     * @return bool
     */
    public function isSameNode(Node $other): bool;
    
    /**
     *
     * @param string $namespaceURI
     * @return string
     */
    public function lookupPrefix(string $namespaceURI): string;
    
    /**
     *
     * @param string $namespaceURI
     * @return bool
     */
    public function isDefaultNamespace(string $namespaceURI): bool;
    
    /**
     *
     * @param string $prefix
     * @return string
     */
    public function lookupNamespaceURI(string $prefix): string;
    
    /**
     *
     * @param Node $arg
     * @return bool
     */
    public function isEqualNode(Node $arg): bool;
    
    /**
     *
     * @param string $feature
     * @param string $version
     * @return Node
     */
    public function getFeature(string $feature, string $version): Node;
    
    /**
     *
     * @param string $key
     * @param Object $data
     * @param UserDataHandler $handler
     * @return Object
     */
    public function setUserData(string $key, Object $data, UserDataHandler $handler): Object;
    
    /**
     *
     * @param string $key
     * @return Object
     */
    public function getUserData(string $key): Object;
}