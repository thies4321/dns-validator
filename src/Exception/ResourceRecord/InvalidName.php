<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord;

use Exception;

use function sprintf;

final class InvalidName extends Exception
{
    public static function forHostname(string $hostname): self
    {
        return new self(sprintf('Resource Record name [%s] is not a hostname', $hostname));
    }
}
