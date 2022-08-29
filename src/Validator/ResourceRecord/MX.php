<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\InvalidName;
use DnsValidator\Exception\ResourceRecord\InvalidTtl;
use DnsValidator\Exception\ResourceRecord\InvalidType;
use DnsValidator\Exception\ResourceRecord\MX\InvalidExchangeField;
use DnsValidator\Exception\ResourceRecord\MX\InvalidPreferenceField;

use function explode;
use function filter_var;
use function idn_to_ascii;
use function intval;
use function is_numeric;
use function strpos;

use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;

final class MX extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::MX;

    /**
     * @throws InvalidExchangeField
     * @throws InvalidPreferenceField
     * @throws InvalidName
     * @throws InvalidTtl
     * @throws InvalidType
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        $this->validatePreference($resourceRecord);
        $this->validateExchange($resourceRecord);
    }

    /**
     * @throws InvalidPreferenceField
     */
    private function validatePreference(ResourceRecord $resourceRecord): void
    {
        $preference = explode(' ', $resourceRecord->getContent())[0] ?? null;

        if ($preference === null) {
            throw InvalidPreferenceField::forMissing();
        }

        if (! is_numeric($preference) || strpos($preference, '.')) {
            throw InvalidPreferenceField::forNotNumeric($preference);
        }

        if (intval($preference) < 1 || intval($preference) > 65535) {
            throw InvalidPreferenceField::forContent(intval($preference));
        }
    }

    /**
     * @throws InvalidExchangeField
     */
    private function validateExchange(ResourceRecord $resourceRecord): void
    {
        $exchange = explode(' ', $resourceRecord->getContent())[1] ?? null;

        if ($exchange === null) {
            throw InvalidExchangeField::forMissing();
        }

        if (! filter_var(idn_to_ascii($exchange), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw InvalidExchangeField::forContent($exchange);
        }
    }
}
