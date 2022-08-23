<?php

declare(strict_types=1);

namespace DnsValidator\Entity;

final class Zone
{
    private string $name;

    /**
     * @var ResourceRecord[]
     */
    private array $resourceRecords;

    public function __construct(string $name, array $resourceRecords)
    {

    }
}