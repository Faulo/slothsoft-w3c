<?php
declare(strict_types = 1);
/**
 * Entity
 */
namespace w3c\dom;

interface Entity extends Node {
    
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
    public function getNotationName(): string;
    
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
     * @return string
     */
    public function getXmlVersion(): string;
}