<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidExpireField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Expire field missing in SOA record');
    }

    public static function forNotNumeric(mixed $expire): self
    {
        return new self(sprintf('Expire [%s] is not a numeric value', $expire));
    }

    public static function forContent(int $expire): self
    {
        return new self(sprintf('Expire [%d] is not a valid unsigned 32-bit integer', $expire));
    }

    public static function forLowerThanRefreshAndRetry(int $expire, int $refreshAndRetry): self
    {
        return new self(sprintf('Expire [%s] should be higher than the sum of Refresh and Retry [%d]', $expire, $refreshAndRetry));
    }
}
