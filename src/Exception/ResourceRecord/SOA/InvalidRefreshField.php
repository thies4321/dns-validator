<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidRefreshField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Refresh field missing in SOA record');
    }

    public static function forNotNumeric(mixed $refresh): self
    {
        return new self(sprintf('Refresh [%s] is not a numeric value', $refresh));
    }

    public static function forContent(int $refresh): self
    {
        return new self(sprintf('Refresh [%d] is not a valid unsigned 32-bit integer', $refresh));
    }
}
