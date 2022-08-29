<?php

declare(strict_types=1);

namespace DnsValidator\Exception\ResourceRecord\MX;

use DnsValidator\Enum\ResourceRecordType;
use Exception;

use function sprintf;

final class InvalidPreferenceField extends Exception
{
    public static function forMissing(): self
    {
        return new self(sprintf('Preference field missing in %s record', ResourceRecordType::MX->name));
    }

    public static function forNotNumeric(mixed $preference): self
    {
        return new self(sprintf('Preference field [%s] is not a integer', $preference));
    }

    public static function forContent(int $minimum): self
    {
        return new self(sprintf('Preference field [%d] is not a valid unsigned positive 16-bit integer', $minimum));
    }
}
