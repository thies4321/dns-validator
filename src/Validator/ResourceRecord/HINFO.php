<?php

declare(strict_types=1);

namespace DnsValidator\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;

use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\HINFO\InvalidCpuField;
use DnsValidator\Exception\ResourceRecord\HINFO\InvalidOsField;
use DnsValidator\Exception\ResourceRecord\InvalidContent;
use DnsValidator\Exception\ResourceRecord\InvalidName;
use DnsValidator\Exception\ResourceRecord\InvalidTtl;
use DnsValidator\Exception\ResourceRecord\InvalidType;

use function explode;
use function preg_match;
use function strlen;

final class HINFO extends AbstractResourceRecordValidator implements ResourceRecordValidatorInterface
{
    private const REGEX = '/^[a-zA-Z0-9-\/\s-]+$/';

    public const TYPE = ResourceRecordType::HINFO;

    /**
     * @throws InvalidCpuField
     * @throws InvalidName
     * @throws InvalidOsField
     * @throws InvalidTtl
     * @throws InvalidType
     * @throws InvalidContent
     */
    public function validate(ResourceRecord $resourceRecord): void
    {
        parent::validate($resourceRecord);

        $this->validateCpu($resourceRecord);
        $this->validateOs($resourceRecord);
    }

    /**
     * @throws InvalidCpuField
     */
    private function validateCpu(ResourceRecord $resourceRecord): void
    {
        $cpu = explode(' ', $resourceRecord->getContent())[0] ?? null;

        if ($cpu === null) {
            throw InvalidCpuField::forMissing();
        }

        if (strlen($cpu) < 1 || strlen($cpu) > 40) {
            throw InvalidCpuField::forFieldLength($cpu);
        }

        if (! preg_match(self::REGEX, $cpu)) {
            throw InvalidCpuField::forAllowedCharacters($cpu);
        }
    }

    /**
     * @throws InvalidOsField
     */
    private function validateOs(ResourceRecord $resourceRecord): void
    {
        $os = explode(' ', $resourceRecord->getContent())[1] ?? null;

        if ($os === null) {
            throw InvalidOsField::forMissing();
        }

        if (strlen($os) < 1 || strlen($os) > 40) {
            throw InvalidOsField::forFieldLength($os);
        }

        if (! preg_match(self::REGEX, $os)) {
            throw InvalidOsField::forAllowedCharacters($os);
        }
    }
}
