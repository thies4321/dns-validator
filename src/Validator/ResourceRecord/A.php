<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidRecordContent;
use DnsValidator\Validator\AbstractValidator;
use DnsValidator\Validator\ValidatorInterface;
use function filter_var;

final class A extends AbstractValidator implements ValidatorInterface
{
    public const TYPE = ResourceRecordType::A;

    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        if (! filter_var($resourceRecord->getContent(), FILTER_VALIDATE_IP, ['flags' => FILTER_FLAG_IPV4])) {
            throw InvalidRecordContent::forARecord($resourceRecord->getContent());
        }
    }
}