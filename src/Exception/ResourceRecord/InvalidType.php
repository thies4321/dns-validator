<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord;

use Exception;

use function sprintf;

final class InvalidType extends Exception
{
    public static function forType(string $type): self
    {
        return new self(sprintf('Resource Record Type [%s] is not supported', $type));
    }

    public static function forUnexpected(string $expected, string $received): self
    {
        return new self(sprintf('Expected a Resource Record with type [%s] but received [%s]', $expected, $received));
    }
}
