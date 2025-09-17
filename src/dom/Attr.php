<?php
declare(strict_types = 1);
/**
 * Attr
 */
namespace w3c\dom;

interface Attr extends Node {
    
    /**
     *
     * @return string
     */
    public function getName(): string;
    
    /**
     *
     * @return bool
     */
    public function getSpecified(): bool;
    
    /**
     *
     * @return string
     */
    public function getValue(): string;
    
    /**
     *
     * @param string $value
     * @return void
     */
    public function setValue(string $value): void;
    
    /**
     *
     * @return Element
     */
    public function getOwnerElement(): Element;
    
    /**
     *
     * @return TypeInfo
     */
    public function getSchemaTypeInfo(): TypeInfo;
    
    /**
     *
     * @return bool
     */
    public function getIsId(): bool;
}