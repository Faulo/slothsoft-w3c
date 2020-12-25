<?php
declare(strict_types = 1);
/**
 * Entity
 *
 * @link http://www.w3.org/TR/DOM-Level-3-Core/core.html#ID-527DCFF2
 */
namespace w3c\dom;

interface Entity extends Node {

    /**
     *
     * @return string
     */
    public function getPublicId();

    /**
     *
     * @return string
     */
    public function getSystemId();

    /**
     *
     * @return string
     */
    public function getNotationName();

    /**
     *
     * @return string
     */
    public function getInputEncoding();

    /**
     *
     * @return string
     */
    public function getXmlEncoding();

    /**
     *
     * @return string
     */
    public function getXmlVersion();
}