<?php
declare(strict_types = 1);
/**
 * DocumentType
 */
namespace w3c\dom;

interface DocumentType extends Node {
    
    /**
     *
     * @return string
     */
    public function getName(): string;
    
    /**
     *
     * @return array
     */
    public function getEntities(): array;
    
    /**
     *
     * @return array
     */
    public function getNotations(): array;
    
    /**
     *
     * @return string
     */
    public function getPublicId(): string;
    
    /**
     *
     * @return string
     */
    public function getSystemId(): string;
    
    /**
     *
     * @return string
     */
    public function getInternalSubset(): string;
}