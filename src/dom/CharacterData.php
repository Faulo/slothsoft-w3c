<?php
declare(strict_types = 1);
/**
 * CharacterData
 */
namespace w3c\dom;

interface CharacterData extends Node {
    
    /**
     *
     * @return string
     */
    public function getData(): string;
    
    /**
     *
     * @param string $data
     * @return void
     */
    public function setData(string $data): void;
    
    /**
     *
     * @return int
     */
    public function getLength(): int;
    
    /**
     *
     * @param int $offset
     * @param int $count
     * @return string
     */
    public function substringData(int $offset, int $count): string;
    
    /**
     *
     * @param string $arg
     * @return void
     */
    public function appendData(string $arg): void;
    
    /**
     *
     * @param int $offset
     * @param string $arg
     * @return void
     */
    public function insertData(int $offset, string $arg): void;
    
    /**
     *
     * @param int $offset
     * @param int $count
     * @return void
     */
    public function deleteData(int $offset, int $count): void;
    
    /**
     *
     * @param int $offset
     * @param int $count
     * @param string $arg
     * @return void
     */
    public function replaceData(int $offset, int $count, string $arg): void;
}