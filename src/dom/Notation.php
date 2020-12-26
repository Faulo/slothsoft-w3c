<?php
declare(strict_types = 1);
/**
 * Notation
 */
namespace w3c\dom;

interface Notation extends Node {

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
}