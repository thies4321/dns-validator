<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidNameField;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\InvalidTtl;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;
use function filter_var;

abstract class AbstractValidator implements ValidatorInterface
{
    protected const TYPE = null;

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
        if (! filter_var($name, FILTER_VALIDATE_DOMAIN)) {
            throw InvalidNameField::forName($name);
        }
    }

    protected function validateTtl(int $ttl): void
    {
        if (! filter_var($ttl, FILTER_VALIDATE_INT, ['min_range', 1, 'max_range' => 2147483647])) {
            throw InvalidTtl::forTtl($ttl);
        }
    }
}