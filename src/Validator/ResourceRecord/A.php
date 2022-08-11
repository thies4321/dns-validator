<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Validator\AbstractValidator;
use DnsValidator\Validator\ValidatorInterface;

final class A extends AbstractValidator implements ValidatorInterface
{
    public const TYPE = ResourceRecordType::A;

    public function validate(ResourceRecord $resourceRecord): void
    {
        $this->validateType($resourceRecord->getType());
    }
}