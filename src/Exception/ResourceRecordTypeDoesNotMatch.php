<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

use function sprintf;

final class ResourceRecordTypeDoesNotMatch extends Exception
{
    public static function forType(string $type, string $expectedType): self
    {
        return new self(sprintf('Given type [%s] does not match expected [%s]', $type, $expectedType));
    }
}
