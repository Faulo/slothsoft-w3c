<?php
declare(strict_types = 1);
namespace w3c\dom;
use DOMNode;

/**
 * MutationEvent
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface MutationEvent extends Event {

    public const MODIFICATION = 1;

    public const ADDITION = 2;

    public const REMOVAL = 3;

    /**
     * @param string $typeArg
     * @param bool $canBubbleArg
     * @param bool $cancelableArg
     * @param DOMNode $relatedNodeArg
     * @param string $prevValueArg
     * @param string $newValueArg
     * @param string $attrNameArg
     * @param int $attrChangeArg
     * @return void
     */
    public function initMutationEvent(string $typeArg, bool $canBubbleArg, bool $cancelableArg, DOMNode $relatedNodeArg, string $prevValueArg, string $newValueArg, string $attrNameArg, int $attrChangeArg): void;
}
