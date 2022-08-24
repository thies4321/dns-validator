<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordContent;
use DnsValidator\Exception\InvalidResourceRecordName;
use DnsValidator\Exception\InvalidResourceRecordTtl;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;
use function filter_var;
use const FILTER_FLAG_IPV4;
use const FILTER_VALIDATE_IP;

final class A extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::A;

    /**
     * @throws InvalidResourceRecordContent
     * @throws InvalidResourceRecordName
     * @throws InvalidResourceRecordTtl
     * @throws InvalidResourceRecordType
     * @throws ResourceRecordTypeDoesNotMatch
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        if (! filter_var($resourceRecord->getContent(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw InvalidResourceRecordContent::forInternetAddress($resourceRecord->getContent());
        }
    }
}