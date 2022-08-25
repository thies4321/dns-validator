<?php

declare(strict_types=1);

namespace DnsValidator\unit\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordContent;
use DnsValidator\Validator\ResourceRecord\NS;
use Exception;

final class NSTest extends ValidatorTest
{
    protected const RESOURCE_RECORD_TYPE = ResourceRecordType::NS;

    /**
     * @throws Exception
     */
    public function __construct(?string $name = null, array $data = [], int|string $dataName = '')
    {
        parent::__construct($name, $data, $dataName, new NS());
    }

    private function validResourceRecordProvider(): array
    {
        return [
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'ns1.example.com')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'ns2.google.com')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'ns3.test.com')]
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
        $this->expectException(InvalidResourceRecordContent::class);

        $this->validator->validate($resourceRecord);
    }
}
