<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

final class InvalidResourceRecordContent extends Exception
{
    public static function forInternetAddress(string $internetAddress): self
    {
        return new self('[%s] is not a valid 32 bit Internet Address');
    }
}