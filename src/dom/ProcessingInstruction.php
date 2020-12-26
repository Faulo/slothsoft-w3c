<?php
declare(strict_types = 1);
/**
 * ProcessingInstruction
 */
namespace w3c\dom;

interface ProcessingInstruction extends Node {

    /**
     *
     * @return string
     */
    public function getTarget(): string;

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
}