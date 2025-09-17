<?php
declare(strict_types = 1);
/**
 * Document
 */
namespace w3c\dom;

interface Document extends Node {
    
    /**
     *
     * @return DocumentType
     */
    public function getDoctype(): DocumentType;
    
    /**
     *
     * @return DOMImplementation
     */
    public function getImplementation(): DOMImplementation;
    
    /**
     *
     * @return Element
     */
    public function getDocumentElement(): Element;
    
    /**
     *
     * @return string
     */
    public function getInputEncoding(): string;
    
    /**
     *
     * @return string
     */
    public function getXmlEncoding(): string;
    
    /**
     *
     * @return bool
     */
    public function getXmlStandalone(): bool;
    
    /**
     *
     * @param bool $xmlStandalone
     * @return void
     */
    public function setXmlStandalone(bool $xmlStandalone): void;
    
    /**
     *
     * @return string
     */
    public function getXmlVersion(): string;
    
    /**
     *
     * @param string $xmlVersion
     * @return void
     */
    public function setXmlVersion(string $xmlVersion): void;
    
    /**
     *
     * @return bool
     */
    public function getStrictErrorChecking(): bool;
    
    /**
     *
     * @param bool $strictErrorChecking
     * @return void
     */
    public function setStrictErrorChecking(bool $strictErrorChecking): void;
    
    /**
     *
     * @return string
     */
    public function getDocumentURI(): string;
    
    /**
     *
     * @param string $documentURI
     * @return void
     */
    public function setDocumentURI(string $documentURI): void;
    
    /**
     *
     * @return DOMConfiguration
     */
    public function getDomConfig(): DOMConfiguration;
    
    /**
     *
     * @param string $tagName
     * @return Element
     */
    public function createElement(string $tagName): Element;
    
    /**
     *
     * @return DocumentFragment
     */
    public function createDocumentFragment(): DocumentFragment;
    
    /**
     *
     * @param string $data
     * @return Text
     */
    public function createTextNode(string $data): Text;
    
    /**
     *
     * @param string $data
     * @return Comment
     */
    public function createComment(string $data): Comment;
    
    /**
     *
     * @param string $data
     * @return CDATASection
     */
    public function createCDATASection(string $data): CDATASection;
    
    /**
     *
     * @param string $target
     * @param string $data
     * @return ProcessingInstruction
     */
    public function createProcessingInstruction(string $target, string $data): ProcessingInstruction;
    
    /**
     *
     * @param string $name
     * @return Attr
     */
    public function createAttribute(string $name): Attr;
    
    /**
     *
     * @param string $name
     * @return EntityReference
     */
    public function createEntityReference(string $name): EntityReference;
    
    /**
     *
     * @param string $tagname
     * @return array
     */
    public function getElementsByTagName(string $tagname): array;
    
    /**
     *
     * @param Node $importedNode
     * @param bool $deep
     * @return Node
     */
    public function importNode(Node $importedNode, bool $deep): Node;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $qualifiedName
     * @return Element
     */
    public function createElementNS(string $namespaceURI, string $qualifiedName): Element;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $qualifiedName
     * @return Attr
     */
    public function createAttributeNS(string $namespaceURI, string $qualifiedName): Attr;
    
    /**
     *
     * @param string $namespaceURI
     * @param string $localName
     * @return array
     */
    public function getElementsByTagNameNS(string $namespaceURI, string $localName): array;
    
    /**
     *
     * @param string $elementId
     * @return Element
     */
    public function getElementById(string $elementId): Element;
    
    /**
     *
     * @param Node $source
     * @return Node
     */
    public function adoptNode(Node $source): Node;
    
    /**
     *
     * @return void
     */
    public function normalizeDocument(): void;
    
    /**
     *
     * @param Node $n
     * @param string $namespaceURI
     * @param string $qualifiedName
     * @return Node
     */
    public function renameNode(Node $n, string $namespaceURI, string $qualifiedName): Node;
}