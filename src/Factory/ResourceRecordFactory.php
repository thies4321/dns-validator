<?php

declare(strict_types=1);

namespace DnsValidator\Factory;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Exception\ValidatorDoesNotExist;

final class ResourceRecordFactory
{
    private ResourceRecordValidatorFactory $validatorFactory;

    public function __construct(?ResourceRecordValidatorFactory $validatorFactory = null)
    {
        $this->validatorFactory = $validatorFactory ?? new ResourceRecordValidatorFactory();
    }

    /**
     * @throws ValidatorDoesNotExist
     */
    public function create(string $name, int $ttl, string $type, string $content): ResourceRecord
    {
        return new ResourceRecord(
            $name,
            $ttl,
            $type,
            $content,
            $this->validatorFactory->create($type)
        );
    }
}