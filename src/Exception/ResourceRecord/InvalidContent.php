<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord;

use Exception;

use function sprintf;

final class InvalidContent extends Exception
{
    public static function forInternetAddress(string $internetAddress): self
    {
        return new self(sprintf('[%s] is not a valid 32 bit Internet Address', $internetAddress));
    }

    public static function forDomain(string $domain): self
    {
        return new self(sprintf('[%s] is not a valid IDN domain name', $domain));
    }

    public static function forTooLong(string $content): self
    {
        return new self(sprintf('Content [%s] should not be more than 255 characters', $content));
    }
}
