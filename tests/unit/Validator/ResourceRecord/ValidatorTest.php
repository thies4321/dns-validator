<?php

namespace DnsValidator\unit\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Exception\InvalidResourceRecordName;
use DnsValidator\Exception\InvalidResourceRecordTtl;
use DnsValidator\Exception\ResourceRecordTypeDoesNotMatch;
use DnsValidator\Validator\ResourceRecord\ResourceRecordValidatorInterface;
use Exception;
use PHPUnit\Framework\TestCase;

abstract class ValidatorTest extends TestCase
{
    protected const RESOURCE_RECORD_TYPE = null;

    protected ResourceRecordValidatorInterface $validator;

    /**
     * @throws Exception
     */
    public function __construct(
        ?string $name = null,
        array $data = [],
        int|string $dataName = '',
        ?ResourceRecordValidatorInterface $validator = null
    ) {
        if (! $validator instanceof ResourceRecordValidatorInterface) {
            throw new Exception('Validator is not set');
        }

        $this->validator = $validator;

        parent::__construct($name, $data, $dataName);
    }

    protected function getTestResourceRecord(
        string $name,
        int $ttl,
        string $type,
        string $content
    ): ResourceRecord {
        return new ResourceRecord($name, $ttl, $type, $content, $this->validator);
    }

    public function testInvalidName(): void
    {
        $resourceRecord = $this->getTestResourceRecord('"', 60, static::RESOURCE_RECORD_TYPE->name, '127.0.0.1');

        $this->expectException(InvalidResourceRecordName::class);

        $this->validator->validate($resourceRecord);
    }

    public function testInvalidTtl(): void
    {
        $resourceRecord = $this->getTestResourceRecord('example.com', 0, static::RESOURCE_RECORD_TYPE->name, '127.0.0.1');

        $this->expectException(InvalidResourceRecordTtl::class);

        $this->validator->validate($resourceRecord);
    }

    public function testInvalidType(): void
    {
        $resourceRecord = $this->getTestResourceRecord('example.com', 60, 'BOGUS', '127.0.0.1');

        $this->expectException(ResourceRecordTypeDoesNotMatch::class);

        $this->validator->validate($resourceRecord);
    }
}
