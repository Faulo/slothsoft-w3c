<?php
declare(strict_types = 1);
namespace w3c\dom;

/**
 * MouseEvent
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface MouseEvent extends UIEvent {

    /**
     * @param string $typeArg
     * @param bool $canBubbleArg
     * @param bool $cancelableArg
     * @param object $viewArg
     * @param int $detailArg
     * @param int $screenXArg
     * @param int $screenYArg
     * @param int $clientXArg
     * @param int $clientYArg
     * @param bool $ctrlKeyArg
     * @param bool $altKeyArg
     * @param bool $shiftKeyArg
     * @param bool $metaKeyArg
     * @param int $buttonArg
     * @param EventTarget $relatedTargetArg
     * @return void
     */
    public function initMouseEvent(string $typeArg, bool $canBubbleArg, bool $cancelableArg, object $viewArg, int $detailArg, int $screenXArg, int $screenYArg, int $clientXArg, int $clientYArg, bool $ctrlKeyArg, bool $altKeyArg, bool $shiftKeyArg, bool $metaKeyArg, int $buttonArg, EventTarget $relatedTargetArg): void;
}
