<?php

declare(strict_types=1);

namespace DnsValidator\unit\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\ResourceRecord\InvalidContent;
use DnsValidator\Validator\ResourceRecord\CNAME;

final class CNAMETest extends ValidatorTest
{
    protected const RESOURCE_RECORD_TYPE = ResourceRecordType::CNAME;

    public function __construct(?string $name = null, array $data = [], int|string $dataName = '')
    {
        parent::__construct($name, $data, $dataName, new CNAME());
    }

    private function validResourceRecordProvider(): array
    {
        return [
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'example.com')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'google.com')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'test.com')]
        ];
    }

    /**
     * @dataProvider validResourceRecordProvider
     */
    public function testValidContent(ResourceRecord $resourceRecord): void
    {
        $this->validator->validate($resourceRecord);

        $this->expectNotToPerformAssertions();
    }

    private function invalidResourceRecordProvider(): array
    {
        return [
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '127.0.0.1')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '-----')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '@')]
        ];
    }

    /**
     * @dataProvider invalidResourceRecordProvider
     */
    public function testInvalidContent(ResourceRecord $resourceRecord): void
    {
        $this->expectException(InvalidContent::class);

        $this->validator->validate($resourceRecord);
    }
}
