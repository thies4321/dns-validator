<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Exception\ResourceRecord\InvalidContent;
use function preg_match;

final class PTR extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    private const REGEX = '/^(?:(?:\d[0-9]{0,2}\.){3}\d{0,3}(?:-in\.addr\.arpa\.)?)$/g';

    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        // ^(?:(?:\d[0-9]{0,2}\.){3}\d{0,3}(?:-in\.addr\.arpa\.)?)$

        if (! preg_match(self::REGEX, $resourceRecord->getContent())) {
        }
    }
}
