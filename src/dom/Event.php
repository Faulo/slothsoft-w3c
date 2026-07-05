<?php
declare(strict_types = 1);
namespace w3c\dom;

/**
 * Event
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface Event {

    public const CAPTURING_PHASE = 1;

    public const AT_TARGET = 2;

    public const BUBBLING_PHASE = 3;

    /**
     * @return void
     */
    public function stopPropagation(): void;

    /**
     * @return void
     */
    public function preventDefault(): void;

    /**
     * @param string $eventTypeArg
     * @param bool $canBubbleArg
     * @param bool $cancelableArg
     * @return void
     */
    public function initEvent(string $eventTypeArg, bool $canBubbleArg, bool $cancelableArg): void;
}
