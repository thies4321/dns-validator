<?php

declare(strict_types=1);

namespace DnsValidator\Exception;

use Exception;

use function sprintf;

final class ValidatorDoesNotExist extends Exception
{
    public static function forType(string $type): self
    {
        return new self(sprintf('Validator does not exist for RR type [%s]', $type));
    }
}
