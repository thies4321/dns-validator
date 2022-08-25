<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

use function sprintf;

final class InvalidResourceRecordType extends Exception
{
    public static function forType(string $type): self
    {
        return new self(sprintf('Resource Record Type [%s] is not supported', $type));
    }
}
