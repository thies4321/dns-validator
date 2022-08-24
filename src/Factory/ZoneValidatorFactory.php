<?php

declare(strict_types=1);

namespace DnsValidator\Factory;

use DnsValidator\Validator\ZoneValidator;

final class ZoneValidatorFactory
{
    public function create(): ZoneValidator
    {
        return new ZoneValidator();
    }
}