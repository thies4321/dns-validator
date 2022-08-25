<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordContent;
use DnsValidator\Exception\InvalidResourceRecordName;
use DnsValidator\Exception\InvalidResourceRecordTtl;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;

use function filter_var;
use function idn_to_ascii;

final class CNAME extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::CNAME;

    /**
     * @throws InvalidResourceRecordContent
     * @throws InvalidResourceRecordName
     * @throws InvalidResourceRecordTtl
     * @throws ResourceRecordTypeDoesNotMatch
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        if (
            ! filter_var(idn_to_ascii($resourceRecord->getContent()), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) ||
            filter_var($resourceRecord->getContent(), FILTER_VALIDATE_IP)
        ) {
            throw InvalidResourceRecordContent::forDomain($resourceRecord->getContent());
        }
    }
}
