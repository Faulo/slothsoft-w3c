<?php
declare(strict_types = 1);
/**
 * XPathExpression
 */
namespace w3c\dom;

interface XPathExpression {
    
    /**
     *
     * @param Node $contextNode
     * @param int $type
     * @param XPathResult $result
     * @return XPathResult
     */
    public function evaluate(Node $contextNode, int $type, XPathResult $result): XPathResult;
}