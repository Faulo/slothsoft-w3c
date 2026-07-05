<?php
declare(strict_types = 1);
namespace w3c\dom;

/**
 * UIEvent
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface UIEvent extends Event {

    /**
     * @param string $typeArg
     * @param bool $canBubbleArg
     * @param bool $cancelableArg
     * @param object $viewArg
     * @param int $detailArg
     * @return void
     */
    public function initUIEvent(string $typeArg, bool $canBubbleArg, bool $cancelableArg, object $viewArg, int $detailArg): void;
}
