<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

use function sprintf;

final class InvalidRecordContent extends Exception
{
    public static function forARecord(string $content): self
    {
        return new self(sprintf('Content for A record [%s] is not a valid ipv4 address', $content));
    }
}
