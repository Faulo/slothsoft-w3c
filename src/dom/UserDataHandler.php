<?php
declare(strict_types = 1);
/**
 * UserDataHandler
 */
namespace w3c\dom;

interface UserDataHandler {
    
    const NODE_CLONED = 1;
    
    const NODE_IMPORTED = 2;
    
    const NODE_DELETED = 3;
    
    const NODE_RENAMED = 4;
    
    const NODE_ADOPTED = 5;
    
    /**
     *
     * @param int $operation
     * @param string $key
     * @param Object $data
     * @param Node $src
     * @param Node $dst
     * @return void
     */
    public function handle(int $operation, string $key, Object $data, Node $src, Node $dst): void;
}