<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;

abstract class AbstractValidator implements ValidatorInterface
{
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