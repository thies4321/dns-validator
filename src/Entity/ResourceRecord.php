<?php

declare(strict_types=1);

namespace DnsValidator\Entity;

use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordType;

final class ResourceRecord
{
    private string $name;
    private int $ttl;
    private ResourceRecordType $type;
    private string $content;

    /**
     * @throws InvalidResourceRecordType
     */
    public function __construct(string $name, int $ttl, string $type, string $content)
    {
        $resourceRecordType = ResourceRecordType::tryFrom($type);

        if (! $resourceRecordType instanceof ResourceRecordType) {
            throw InvalidResourceRecordType::forType($type);
        }

        $this->name = $name;
        $this->ttl = $ttl;
        $this->type = $resourceRecordType;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function getType(): string
    {
        return $this->type->value;
    }

    public function getDefiningRfc(): string
    {
        return $this->type->getReference();
    }

    public function getContent(): string
    {
        return $this->content;
    }
}