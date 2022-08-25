<?php

declare(strict_types=1);

namespace DnsValidator\Factory;

use DnsValidator\Collection\ResourceRecordCollection;
use DnsValidator\Entity\Zone;

final class ZoneFactory
{
    private ZoneValidatorFactory $validatorFactory;

    public function __construct(?ZoneValidatorFactory $validatorFactory = null)
    {
        $this->validatorFactory = $validatorFactory ?? new ZoneValidatorFactory();
    }

    public function create($name, ResourceRecordCollection $resourceRecordCollection): Zone
    {
        return new Zone(
            $name,
            $resourceRecordCollection,
            $this->validatorFactory->create()
        );
    }
}
