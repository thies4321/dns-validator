<?php

declare(strict_types=1);

namespace DnsValidator\Factory;

use DnsValidator\Exception\ValidatorDoesNotExist;
use DnsValidator\Validator\ResourceRecord\ResourceRecordValidatorInterface;

use function class_exists;
use function sprintf;

class ResourceRecordValidatorFactory
{
    public function create(string $type): ResourceRecordValidatorInterface
    {
        $class = sprintf('DnsValidator\Validator\ResourceRecord\%s', $type);

        if (! class_exists($class)) {
            throw ValidatorDoesNotExist::forType($type);
        }

        return new $class;
    }
}