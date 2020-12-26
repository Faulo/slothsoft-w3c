<?php
declare(strict_types = 1);
/**
 * DOMImplementation
 */
namespace w3c\dom;

interface DOMImplementation {

    /**
     *
     * @param string $feature
     * @param string $version
     * @return bool
     */
    public function hasFeature(string $feature, string $version): bool;

    /**
     *
     * @param string $qualifiedName
     * @param string $publicId
     * @param string $systemId
     * @return DocumentType
     */
    public function createDocumentType(string $qualifiedName, string $publicId, string $systemId): DocumentType;

    /**
     *
     * @param string $namespaceURI
     * @param string $qualifiedName
     * @param DocumentType $doctype
     * @return Document
     */
    public function createDocument(string $namespaceURI, string $qualifiedName, DocumentType $doctype): Document;

    /**
     *
     * @param string $feature
     * @param string $version
     * @return DOMImplementation
     */
    public function getFeature(string $feature, string $version): DOMImplementation;
}