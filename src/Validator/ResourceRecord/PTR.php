<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\InvalidContent;
use DnsValidator\Exception\ResourceRecord\InvalidName;
use DnsValidator\Exception\ResourceRecord\InvalidTtl;
use DnsValidator\Exception\ResourceRecord\InvalidType;
use function filter_var;
use function preg_match;
use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;

final class PTR extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::PTR;

    /**
     * @throws InvalidContent
     * @throws InvalidName
     * @throws InvalidTtl
     * @throws InvalidType
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        if (! filter_var($resourceRecord->getContent(), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw InvalidContent::forDomain($resourceRecord->getContent());
        }
    }
}
