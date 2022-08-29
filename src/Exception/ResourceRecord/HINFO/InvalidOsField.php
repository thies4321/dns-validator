<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\HINFO;

use Exception;

use function sprintf;
use function strlen;

final class InvalidOsField extends Exception
{
    public static function forMissing(): self
    {
        return new self('OS field missing in HINFO record');
    }

    public static function forFieldLength(string $cpu): self
    {
        return new self(sprintf('OS field must be between 1 and 40 characters. Given OS field is [%d] long', strlen($cpu)));
    }

    public static function forAllowedCharacters(string $cpu): self
    {
        return new self(sprintf('Given OS field [%s] is invalid. OS field can only contain letters, digits, hyphens and slashes.', $cpu));
    }
}