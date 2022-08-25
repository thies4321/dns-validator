<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Entity\Zone;

class ZoneValidator implements ZoneValidatorInterface
{
    public function validate(Zone $zone): void
    {
        echo $zone->getName();
    }
}
