<?php
declare(strict_types = 1);
namespace w3c\dom;

/**
 * DocumentEvent
 *
 * @see https://www.w3.org/TR/2000/REC-DOM-Level-2-Events-20001113/events.html
 */

interface DocumentEvent {

    /**
     * @param string $eventType
     * @return Event
     */
    public function createEvent(string $eventType): Event;
}
