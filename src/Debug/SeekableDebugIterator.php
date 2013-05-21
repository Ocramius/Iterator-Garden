<?php
/**
 * Iterator Garden
 */

/**
 * Class SeekableDebugIterator
 *
 * A DebugIterator that shows seekable events.
 */
class SeekableDebugIterator extends DebugIterator implements SeekableIterator
{
    private $innerSeekableIterator;

    public function __construct(SeekableIterator $it)
    {
        $this->innerSeekableIterator = $it;
        parent::__construct($it);
    }

    public function current() {
        $this->event(__FUNCTION__ . '()');
        $current = $this->innerSeekableIterator->current();
        $this->event(sprintf('self::$innerSeekableIterator->current() is %s', $this->varLabel($current)));
        return $current;
    }

    public function key() {
        $this->event(__FUNCTION__ . '()');
        $key = $this->innerSeekableIterator->key();
        $this->event(sprintf('self::$innerSeekableIterator->key() is %s', $this->varLabel($key)));
        return $key;

    }

    public function seek($position) {
        $this->event(sprintf('%s(%d)', __FUNCTION__, $position));
        $this->innerSeekableIterator->seek($position);
    }
}
