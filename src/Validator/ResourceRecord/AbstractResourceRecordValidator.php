<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Exception\ResourceRecord\InvalidName;
use DnsValidator\Exception\ResourceRecord\InvalidTtl;
use DnsValidator\Exception\ResourceRecord\InvalidType;

use function filter_var;
use function idn_to_ascii;

use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_INT;

abstract class AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    /**
     * @throws InvalidName
     * @throws InvalidTtl
     * @throws InvalidType
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        $this->validateName($resourceRecord->getName());
        $this->validateTtl($resourceRecord->getTtl());
        $this->validateType($resourceRecord->getType());
    }

    /**
     * @throws InvalidName
     */
    protected function validateName(string $name): void
    {
        if (! filter_var(idn_to_ascii($name), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw InvalidName::forHostname($name);
        }
    }

    /**
     * @throws InvalidTtl
     */
    protected function validateTtl(int $ttl): void
    {
        if (! filter_var($ttl, FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidTtl::forInteger($ttl);
        }
    }

    /**
     * @throws InvalidType
     */
    protected function validateType(string $type): void
    {
        if ($type !== static::TYPE->name) {
            throw InvalidType::forUnexpected(static::TYPE->name, $type);
        }
    }
}
