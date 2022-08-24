<?php

declare(strict_types=1);

namespace DnsValidator\Entity;

use DnsValidator\Collection\ResourceRecordCollection;
use DnsValidator\Validator\ZoneValidatorInterface;
use Exception;

use function array_map;
use function iterator_to_array;

final class Zone
{
    private string $name;
    private ResourceRecordCollection $resourceRecordCollection;
    private ZoneValidatorInterface $validator;

    public function __construct(
        string $name,
        ResourceRecordCollection $resourceRecordCollection,
        ZoneValidatorInterface $validator
    ) {
        $this->name = $name;
        $this->resourceRecordCollection = $resourceRecordCollection;
        $this->validator = $validator;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ResourceRecord[]
     *
     * @throws Exception
     */
    public function getResourceRecords(): array
    {
        return array_map(function (ResourceRecord $resourceRecord) {
            return $resourceRecord;
        }, iterator_to_array($this->resourceRecordCollection->getIterator()));
    }

    public function validate(): void
    {
        foreach ($this->getResourceRecords() as $resourceRecord) {
            $resourceRecord->validate();
        }
    }
}