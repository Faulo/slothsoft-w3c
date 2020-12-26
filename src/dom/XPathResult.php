<?php
declare(strict_types = 1);
/**
 * XPathResult
 */
namespace w3c\dom;

interface XPathResult {

    const ANY_TYPE = 0;

    const NUMBER_TYPE = 1;

    const STRING_TYPE = 2;

    const BOOLEAN_TYPE = 3;

    const UNORDERED_NODE_ITERATOR_TYPE = 4;

    const ORDERED_NODE_ITERATOR_TYPE = 5;

    const UNORDERED_NODE_SNAPSHOT_TYPE = 6;

    const ORDERED_NODE_SNAPSHOT_TYPE = 7;

    const ANY_UNORDERED_NODE_TYPE = 8;

    const FIRST_ORDERED_NODE_TYPE = 9;

    /**
     *
     * @return int
     */
    public function getResultType(): int;

    /**
     *
     * @return float
     */
    public function getNumberValue(): float;

    /**
     *
     * @return string
     */
    public function getStringValue(): string;

    /**
     *
     * @return bool
     */
    public function getBooleanValue(): bool;

    /**
     *
     * @return Node
     */
    public function getSingleNodeValue(): Node;

    /**
     *
     * @return bool
     */
    public function getInvalidIteratorState(): bool;

    /**
     *
     * @return int
     */
    public function getSnapshotLength(): int;

    /**
     *
     * @return Node
     */
    public function iterateNext(): Node;

    /**
     *
     * @param int $index
     * @return Node
     */
    public function snapshotItem(int $index): Node;
}