<?php

declare(strict_types=1);

namespace DnsValidator\Collection;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Iterator\ResourceRecordIterator;
use IteratorAggregate;
use Traversable;

final class ResourceRecordCollection implements IteratorAggregate
{
    /**
     * @var ResourceRecord[]
     */
    private array $items = [];

    /**
     * @return ResourceRecord[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(ResourceRecord $resourceRecord): void
    {
        $this->items[] = $resourceRecord;
    }

    public function getIterator(): Traversable
    {
        return new ResourceRecordIterator($this);
    }
}