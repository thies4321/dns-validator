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

use const FILTER_FLAG_IPV4;
use const FILTER_VALIDATE_IP;

final class A extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::A;

    /**
     * @throws InvalidContent
     * @throws InvalidName
     * @throws InvalidTtl
     * @throws InvalidType
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        if (! filter_var($resourceRecord->getContent(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw InvalidContent::forInternetAddress($resourceRecord->getContent());
        }
    }
}
