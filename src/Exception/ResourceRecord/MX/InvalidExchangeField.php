<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\MX;

use DnsValidator\Enum\ResourceRecordType;
use Exception;
use function sprintf;

final class InvalidExchangeField extends Exception
{
    public static function forMissing(): self
    {
        return new self(sprintf('Exchange field missing in %s record', ResourceRecordType::MX->name));
    }

    public static function forContent(string $hostmaster): self
    {
        return new self(sprintf('Exchange field [%s] is not a valid hostname', $hostmaster));
    }
}
