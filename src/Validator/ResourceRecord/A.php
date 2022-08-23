<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordType;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;

final class A extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::A;

    /**
     * @throws InvalidResourceRecordType
     * @throws ResourceRecordTypeDoesNotMatch
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);
    }

    protected function validateName(string $name): void
    {
        echo 'hoi';
    }
}