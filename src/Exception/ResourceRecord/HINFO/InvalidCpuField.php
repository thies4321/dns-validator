<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\HINFO;

use Exception;

use function sprintf;
use function strlen;

final class InvalidCpuField extends Exception
{
    public static function forMissing(): self
    {
        return new self('CPU field missing in HINFO record');
    }

    public static function forFieldLength(string $cpu): self
    {
        return new self(sprintf('CPU field must be between 1 and 40 characters. Given CPU field is [%d] long', strlen($cpu)));
    }

    public static function forAllowedCharacters(string $cpu): self
    {
        return new self(sprintf('Given CPU field [%s] is invalid. CPU field can only contain letters, digits, hyphens and slashes.', $cpu));
    }
}