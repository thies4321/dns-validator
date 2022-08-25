<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidPrimaryField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Primary field missing in SOA record');
    }

    public static function forContent(string $primary): self
    {
        return new self(sprintf('Primary [%s] is not a valid hostname', $primary));
    }
}
