<?php

declare(strict_types=1);

namespace DnsValidator\Iterator;

use DnsValidator\Collection\ResourceRecordCollection;
use DnsValidator\Entity\ResourceRecord;
use Iterator;

class ResourceRecordIterator implements Iterator
{
    private ResourceRecordCollection $collection;
    private int $position = 0;

    public function __construct(ResourceRecordCollection $collection)
    {
        $this->collection = $collection;
    }

    public function current(): ResourceRecord
    {
        return $this->collection->getItems()[$this->position];
    }

    public function next(): void
    {
        $this->position = ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection->getItems()[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = $this->position > 0 ? --$this->position : 0;
    }
}