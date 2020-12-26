<?php
declare(strict_types = 1);
/**
 * XPathEvaluator
 */
namespace w3c\dom;

interface XPathEvaluator {

    /**
     *
     * @param string $expression
     * @param XPathNSResolver $resolver
     * @return XPathExpression
     */
    public function createExpression(string $expression, XPathNSResolver $resolver): XPathExpression;

    /**
     *
     * @param Node $nodeResolver
     * @return XPathNSResolver
     */
    public function createNSResolver(Node $nodeResolver): XPathNSResolver;

    /**
     *
     * @param string $expression
     * @param Node $contextNode
     * @param XPathNSResolver $resolver
     * @param int $type
     * @param XPathResult $result
     * @return XPathResult
     */
    public function evaluate(string $expression, Node $contextNode, XPathNSResolver $resolver, int $type, XPathResult $result): XPathResult;
}