<?php
declare(strict_types = 1);
namespace w3c;

/**
 * EventTarget
 *
 * @link https://dom.spec.whatwg.org/#eventtarget
 */
interface EventTarget {

    public function addEventListener(string $type, callable $listener, bool $capture = false): void;

    public function removeEventListener(string $type, callable $listener, bool $capture = false): void;

    public function dispatchEvent($event): bool;
}
