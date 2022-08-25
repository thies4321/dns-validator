<?php

declare(strict_types=1);

namespace DnsValidator\unit\Validator\ResourceRecord;

use DnsValidator\Entity\ResourceRecord;
use DnsValidator\Enum\ResourceRecordType;
use DnsValidator\Exception\InvalidResourceRecordContent;
use DnsValidator\Validator\ResourceRecord\A;
use Exception;

final class ATest extends ValidatorTest
{
    protected const RESOURCE_RECORD_TYPE = ResourceRecordType::A;

    /**
     * @throws Exception
     */
    public function __construct(?string $name = null, array $data = [], int|string $dataName = '')
    {
        parent::__construct($name, $data, $dataName, new A());
    }

    private function validResourceRecordProvider(): array
    {
        return [
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '127.0.0.1')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '192.0.0.1')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '255.255.255.255')]
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
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '127.0.0.1/24')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, 'example.com')],
            [$this->getTestResourceRecord('example.com', 60, self::RESOURCE_RECORD_TYPE->name, '2001:0db8:85a3:0000:0000:8a2e:0370:7334')]
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
