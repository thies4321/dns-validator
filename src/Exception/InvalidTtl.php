<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;
use function sprintf;

final class InvalidTtl extends Exception
{
    public static function forTtl(int $ttl): self
    {
        return new self(sprintf('TTL [%d] not within valid range of 32 bit signed integer', $ttl));
    }
}