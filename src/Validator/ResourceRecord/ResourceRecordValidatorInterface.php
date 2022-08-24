<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;

interface ResourceRecordValidatorInterface
{
    public function validate(ResourceRecord $resourceRecord): void;
}
