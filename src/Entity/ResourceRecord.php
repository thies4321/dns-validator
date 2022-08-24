<?php

declare(strict_types=1);

namespace DnsValidator\Entity;

use DnsValidator\Validator\ResourceRecord\ResourceRecordValidatorInterface;

final class ResourceRecord
{
    private string $name;
    private int $ttl;
    private string $type;
    private string $content;
    private ResourceRecordValidatorInterface $validator;

    public function __construct(
        string $name,
        int $ttl,
        string $type,
        string $content,
        ResourceRecordValidatorInterface $validator
    ) {
        $this->name = $name;
        $this->ttl = $ttl;
        $this->type = $type;
        $this->content = $content;
        $this->validator = $validator;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function validate(): void
    {
        $this->validator->validate($this);
    }
}
