<?php
namespace w3c\dom;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testNodeTypes() {
        $this->assertEquals(Node::ELEMENT_NODE, XML_ELEMENT_NODE);
        $this->assertEquals(Node::ATTRIBUTE_NODE, XML_ATTRIBUTE_NODE);
        //etc
    }
}

