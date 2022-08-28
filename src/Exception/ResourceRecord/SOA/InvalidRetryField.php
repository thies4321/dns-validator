<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidRetryField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Retry field missing in SOA record');
    }

    public static function forNotNumeric(mixed $retry): self
    {
        return new self(sprintf('Retry [%s] is not a numeric value', $retry));
    }

    public static function forContent(int $retry): self
    {
        return new self(sprintf('Retry [%d] is not a valid unsigned 32-bit integer', $retry));
    }

    public static function forHigherThanRefresh(int $retry, int $refresh): self
    {
        return new self(sprintf('Retry [%d] should not be higher or equal to Refresh [%d]', $retry, $refresh));
    }
}
