<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;

abstract class AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    /**
     * @throws InvalidResourceRecordType
     * @throws ResourceRecordTypeDoesNotMatch
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        $this->validateType($resourceRecord->getType());
        $this->validateName($resourceRecord->getName());
        $this->validateTtl($resourceRecord->getTtl());
    }

    /**
     * @throws InvalidResourceRecordType
     * @throws ResourceRecordTypeDoesNotMatch
     */
    protected function validateType(string $type): void
    {
        $resourceRecordType = ResourceRecordType::tryFrom($type);

        if (! $resourceRecordType instanceof ResourceRecordType) {
            throw InvalidResourceRecordType::forType($type);
        }

        if ($resourceRecordType !== static::TYPE) {
            throw ResourceRecordTypeDoesNotMatch::forType($type, static::TYPE->value);
        }
    }

    protected function validateName(string $name): void
    {

    }

    protected function validateTtl(int $ttl): void
    {

    }
}