<?php
declare(strict_types = 1);
/**
 * DOMConfiguration
 */
namespace w3c\dom;

interface DOMConfiguration {

    /**
     *
     * @return array
     */
    public function getParameterNames(): array;

    /**
     *
     * @param string $name
     * @param Object $value
     * @return void
     */
    public function setParameter(string $name, Object $value): void;

    /**
     *
     * @param string $name
     * @return Object
     */
    public function getParameter(string $name): Object;

    /**
     *
     * @param string $name
     * @param Object $value
     * @return bool
     */
    public function canSetParameter(string $name, Object $value): bool;
}