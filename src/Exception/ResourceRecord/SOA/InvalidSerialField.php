<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\SOA;

use Exception;

use function sprintf;

final class InvalidSerialField extends Exception
{
    public static function forMissing(): self
    {
        return new self('Serial field missing in SOA record');
    }

    public static function forNotNumeric(mixed $serial): self
    {
        return new self(sprintf('Serial [%s] is not a numeric value', $serial));
    }

    public static function forContent(int $serial): self
    {
        return new self(sprintf('Serial [%d] is not a valid unsigned 32-bit integer', $serial));
    }
}
