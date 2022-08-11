<?php

declare(strict_types=1);

namespace DnsValidator\Entity;

use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordType;

final class ResourceRecord
{
    private ResourceRecordType $type;

    /**
     * @throws InvalidResourceRecordType
     */
    public function __construct(string $type)
    {
        $resourceRecordType = ResourceRecordType::tryFrom($type);

        if (! $resourceRecordType instanceof ResourceRecordType) {
            throw InvalidResourceRecordType::forType($type);
        }

        $this->type = $resourceRecordType;
    }


}