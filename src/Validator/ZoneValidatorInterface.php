<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Entity\Zone;

interface ZoneValidatorInterface
{
    public function validate(Zone $zone): void;
}