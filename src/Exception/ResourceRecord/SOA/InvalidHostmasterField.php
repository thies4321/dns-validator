<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;
use function sprintf;

final class InvalidHostmasterField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Hostmaster field missing in SOA record');
    }

    public static function forContent(string $hostmaster): self
    {
        return new self(sprintf('Hostmaster [%s] is not a valid email', $hostmaster));
    }
}
