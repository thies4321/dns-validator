<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidMinimumField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Minimum field missing in SOA record');
    }

    public static function forNotNumeric(mixed $minimum): self
    {
        return new self(sprintf('Minimum [%s] is not a numeric value', $minimum));
    }

    public static function forContent(int $minimum): self
    {
        return new self(sprintf('Minimum [%d] is not a valid unsigned 32-bit integer', $minimum));
    }
}
