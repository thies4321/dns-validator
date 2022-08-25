<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidPrimaryField;

use function explode;
use function filter_var;
use function idn_to_ascii;

use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_IP;

final class SOA extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::SOA;

    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        $this->validatePrimary($resourceRecord);
        $this->validateHostmaster($resourceRecord);
        $this->validateSerial($resourceRecord);
        $this->validateRefresh($resourceRecord);
        $this->validateRetry($resourceRecord);
        $this->validateExpire($resourceRecord);
        $this->validateMinimum($resourceRecord);
    }

    /**
     * @throws InvalidPrimaryField
     */
    private function validatePrimary(ResourceRecord $resourceRecord): void
    {
        $primary = explode(' ', $resourceRecord->getContent())[0] ?? null;

        if ($primary === null) {
            throw InvalidPrimaryField::forMissing();
        }

        if (
            ! filter_var(idn_to_ascii($primary), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) ||
            filter_var($primary, FILTER_VALIDATE_IP)
        ) {
            throw InvalidPrimaryField::forContent($primary);
        }
    }

    private function validateHostmaster(ResourceRecord $resourceRecord): void
    {
        $hostmaster = explode(' ', $resourceRecord->getContent())[1] ?? null;

        if ($hostmaster === null) {
        }
    }

    private function validateSerial(ResourceRecord $resourceRecord): void
    {
    }

    private function validateRefresh(ResourceRecord $resourceRecord): void
    {
    }

    private function validateRetry(ResourceRecord $resourceRecord): void
    {
    }

    private function validateExpire(ResourceRecord $resourceRecord): void
    {
    }

    private function validateMinimum(ResourceRecord $resourceRecord): void
    {
    }
}
