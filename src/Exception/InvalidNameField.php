<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

use function sprintf;

final class InvalidNameField extends Exception
{
    public static function forName(string $name): self
    {
        return new self(sprintf('Name field [%s] of record is invalid', $name));
    }
}