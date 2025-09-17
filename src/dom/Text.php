<?php
declare(strict_types = 1);
/**
 * Text
 */
namespace w3c\dom;

interface Text extends CharacterData {
    
    /**
     *
     * @return bool
     */
    public function getIsElementContentWhitespace(): bool;
    
    /**
     *
     * @return string
     */
    public function getWholeText(): string;
    
    /**
     *
     * @param int $offset
     * @return Text
     */
    public function splitText(int $offset): Text;
    
    /**
     *
     * @param string $content
     * @return Text
     */
    public function replaceWholeText(string $content): Text;
}