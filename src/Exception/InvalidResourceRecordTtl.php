<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

final class InvalidResourceRecordTtl extends Exception
{
    public static function forInteger(int $integer): self
    {
        return new self('TTL [%d] for RR is not a valid positive unsigned 32-bit integer');
    }
}