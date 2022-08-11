<?php

declare(strict_types=1);

namespace DnsValidator\Validator;

use DnsValidator\Entity\ResourceRecord;

final class ResourceRecordValidator implements ValidatorInterface
{
    public function validate(ResourceRecord $resourceRecord): void
    {
        $class = sprintf('DnsValidator\Validator\ResourceRecord\%s', $resourceRecord->getType());

        if (! class_exists($class)) {
            throw new \Exception('wut');
        }

        /** @var ValidatorInterface $validator */
        $validator = new $class;
        $validator->validate($resourceRecord);
    }
}