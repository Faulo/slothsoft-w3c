<?php
declare(strict_types = 1);
/**
 * TypeInfo
 */
namespace w3c\dom;

interface TypeInfo {

    const DERIVATION_RESTRICTION = 0x00000001;

    const DERIVATION_EXTENSION = 0x00000002;

    const DERIVATION_UNION = 0x00000004;

    const DERIVATION_LIST = 0x00000008;

    /**
     *
     * @return string
     */
    public function getTypeName(): string;

    /**
     *
     * @return string
     */
    public function getTypeNamespace(): string;

    /**
     *
     * @param string $typeNamespaceArg
     * @param string $typeNameArg
     * @param int $derivationMethod
     * @return bool
     */
    public function isDerivedFrom(string $typeNamespaceArg, string $typeNameArg, int $derivationMethod): bool;
}