<?php
declare(strict_types = 1);
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {

    public function testNodeTypes() {
        $this->assertEquals(Node::ELEMENT_NODE, XML_ELEMENT_NODE);
        $this->assertEquals(Node::ATTRIBUTE_NODE, XML_ATTRIBUTE_NODE);
        $this->assertEquals(Node::TEXT_NODE, XML_TEXT_NODE);
        $this->assertEquals(Node::CDATA_SECTION_NODE, XML_CDATA_SECTION_NODE);
        $this->assertEquals(Node::ENTITY_REFERENCE_NODE, XML_ENTITY_REF_NODE);
        $this->assertEquals(Node::ENTITY_NODE, XML_ENTITY_NODE);
        $this->assertEquals(Node::PROCESSING_INSTRUCTION_NODE, XML_PI_NODE);
        $this->assertEquals(Node::COMMENT_NODE, XML_COMMENT_NODE);
        $this->assertEquals(Node::DOCUMENT_NODE, XML_DOCUMENT_NODE);
        $this->assertEquals(Node::DOCUMENT_TYPE_NODE, XML_DOCUMENT_TYPE_NODE);
        $this->assertEquals(Node::DOCUMENT_FRAGMENT_NODE, XML_DOCUMENT_FRAG_NODE);
        $this->assertEquals(Node::NOTATION_NODE, XML_NOTATION_NODE);
    }
}

