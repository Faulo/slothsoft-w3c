<?php
declare(strict_types = 1);
namespace w3c\dom;

/**
 * EventTarget
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface EventTarget {

    /**
     * @param string $type
     * @param callable $listener
     * @param bool $useCapture
     * @return void
     */
    public function addEventListener(string $type, callable $listener, bool $useCapture): void;

    /**
     * @param string $type
     * @param callable $listener
     * @param bool $useCapture
     * @return void
     */
    public function removeEventListener(string $type, callable $listener, bool $useCapture): void;

    /**
     * @param Event $evt
     * @return bool
     */
    public function dispatchEvent(Event $evt): bool;
}
