<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\InvalidContent;
use DnsValidator\Exception\ResourceRecord\InvalidName;
use DnsValidator\Exception\ResourceRecord\InvalidTtl;
use DnsValidator\Exception\ResourceRecord\InvalidType;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidExpireField;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidHostmasterField;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidMinimumField;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidPrimaryField;

use DnsValidator\Exception\ResourceRecord\SOA\InvalidRefreshField;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidRetryField;
use DnsValidator\Exception\ResourceRecord\SOA\InvalidSerialField;
use function array_pop;
use function explode;
use function filter_var;
use function filter_var_array;
use function idn_to_ascii;

use function implode;
use function intval;
use function is_integer;
use function is_numeric;
use function print_r;
use function sprintf;
use function str_replace;
use function strpos;
use function substr;
use function substr_replace;
use function var_dump;
use const FILTER_FLAG_HOSTNAME;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_IP;

final class SOA extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    public const TYPE = ResourceRecordType::SOA;

    /**
     * @throws InvalidExpireField
     * @throws InvalidHostmasterField
     * @throws InvalidMinimumField
     * @throws InvalidName
     * @throws InvalidPrimaryField
     * @throws InvalidRefreshField
     * @throws InvalidRetryField
     * @throws InvalidSerialField
     * @throws InvalidTtl
     * @throws InvalidType
     * @throws InvalidContent
     */
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

    /**
     * @throws InvalidHostmasterField
     */
    private function validateHostmaster(ResourceRecord $resourceRecord): void
    {
        $hostmaster = explode(' ', $resourceRecord->getContent())[1] ?? null;

        if ($hostmaster === null) {
            throw InvalidHostmasterField::forMissing();
        }

        $hostname = str_replace('\.', '.', $hostmaster);

        if (! filter_var($hostname, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) || filter_var($hostname, FILTER_VALIDATE_IP)) {
            throw InvalidHostmasterField::forContent($hostmaster);
        }
    }

    /**
     * @throws InvalidSerialField
     */
    private function validateSerial(ResourceRecord $resourceRecord): void
    {
        $serial = explode(' ', $resourceRecord->getContent())[2] ?? null;

        if ($serial === null) {
            throw InvalidSerialField::forMissing();
        }

        if (! is_numeric($serial)) {
            throw InvalidSerialField::forNotNumeric($serial);
        }

        if (! filter_var(intval($serial), FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidSerialField::forContent(intval($serial));
        }
    }

    /**
     * @throws InvalidRefreshField
     */
    private function validateRefresh(ResourceRecord $resourceRecord): void
    {
        $refresh = explode(' ', $resourceRecord->getContent())[3] ?? null;

        if ($refresh === null) {
            throw InvalidRefreshField::forMissing();
        }

        if (! is_numeric($refresh)) {
            throw InvalidRefreshField::forNotNumeric($refresh);
        }

        if (! filter_var(intval($refresh), FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidRefreshField::forContent(intval($refresh));
        }
    }

    /**
     * @throws InvalidRetryField
     */
    private function validateRetry(ResourceRecord $resourceRecord): void
    {
        $retry = explode(' ', $resourceRecord->getContent())[4] ?? null;

        if ($retry === null) {
            throw InvalidRetryField::forMissing();
        }

        if (! is_numeric($retry)) {
            throw InvalidRetryField::forNotNumeric($retry);
        }

        if (! filter_var(intval($retry), FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidRetryField::forContent(intval($retry));
        }

        $refresh = intval(explode(' ', $resourceRecord->getContent())[3]);

        if (intval($retry) >= $refresh) {
            throw InvalidRetryField::forHigherThanRefresh((intval($retry)), $refresh);
        }
    }

    /**
     * @throws InvalidExpireField
     */
    private function validateExpire(ResourceRecord $resourceRecord): void
    {
        $expire = explode(' ', $resourceRecord->getContent())[5] ?? null;

        if ($expire === null) {
            throw InvalidExpireField::forMissing();
        }

        if (! is_numeric($expire)) {
            throw InvalidExpireField::forNotNumeric($expire);
        }

        if (! filter_var(intval($expire), FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidExpireField::forContent(intval($expire));
        }

        $refresh = intval(explode(' ', $resourceRecord->getContent())[3]);
        $retry = intval(explode(' ', $resourceRecord->getContent())[4]);

        if (intval($expire) <= ($refresh + $retry)) {
            throw InvalidExpireField::forLowerThanRefreshAndRetry(intval($expire), ($refresh + $retry));
        }
    }

    /**
     * @throws InvalidMinimumField
     */
    private function validateMinimum(ResourceRecord $resourceRecord): void
    {
        $minimum = explode(' ', $resourceRecord->getContent())[6] ?? null;

        if ($minimum === null) {
            throw InvalidMinimumField::forMissing();
        }

        if (! is_numeric($minimum)) {
            throw InvalidMinimumField::forNotNumeric($minimum);
        }

        if (! filter_var(intval($minimum), FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 2147483647])) {
            throw InvalidMinimumField::forContent(intval($minimum));
        }
    }
}
