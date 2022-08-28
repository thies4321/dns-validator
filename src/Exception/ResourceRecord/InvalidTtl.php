<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord;

use Exception;

use function sprintf;

final class InvalidTtl extends Exception
{
    public static function forInteger(int $integer): self
    {
        return new self(sprintf('TTL [%d] for RR is not a valid positive unsigned 32-bit integer', $integer));
    }
}
