<?php

declare(strict_types=1);

namespace DnsValidator\Service;

use DnsValidator\Exception\ValidatorDoesNotExist;
use DnsValidator\Factory\ResourceRecordFactory;

final class DnsValidatorService
{
    private ResourceRecordFactory $resourceRecordFactory;

    public function __construct(?ResourceRecordFactory $resourceRecordFactory = null)
    {
        $this->resourceRecordFactory = $resourceRecordFactory ?? new ResourceRecordFactory();
    }

    /**
     * @throws ValidatorDoesNotExist
     */
    public function validateResourceRecord(string $name, int $ttl, string $type, string $content): void
    {
        $resourceRecord = $this->resourceRecordFactory->create($name, $ttl, $type, $content);
        $resourceRecord->validate();
    }

    public function validateZone(string $name, array $resourceRecordData): void
    {
    }
}
