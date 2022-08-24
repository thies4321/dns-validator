<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordName;
use DnsValidator\Exception\InvalidResourceRecordTtl;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;
use function filter_var;
use function idn_to_ascii;
use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_INT;

abstract class AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    /**
     * @throws InvalidResourceRecordName
     * @throws InvalidResourceRecordTtl
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

    /**
     * @throws InvalidResourceRecordName
     */
    protected function validateName(string $name): void
    {
        if (! filter_var(idn_to_ascii($name), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw InvalidResourceRecordName::forHostname($name);
        }
    }

    /**
     * @throws InvalidResourceRecordTtl
     */
    protected function validateTtl(int $ttl): void
    {
        if (! filter_var($ttl, FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidResourceRecordTtl::forInteger($ttl);
        }
    }
}