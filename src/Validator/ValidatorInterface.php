<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Entity\ResourceRecord;

interface ValidatorInterface
{
    public function validate(ResourceRecord $resourceRecord): void;
}