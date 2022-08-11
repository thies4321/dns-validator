<?php

declare(strict_types=1);

namespace DnsValidator\Enum;

enum ResourceRecordType: string
{
    case A = 'A'; // 1
    case NS = 'NS'; // 2
    case CNAME = 'CNAME'; // 5
    case SOA = 'SOA'; // 6
    case PTR = 'PTR'; // 12
    case HINFO = 'HINFO'; // 13
    case MX = 'MX'; // 15
    case TXT = 'TXT'; // 16
    case RP = 'RP'; // 17
    case AFSDB = 'AFSDB'; // 18
    case SIG = 'SIG'; // 24
    case KEY = 'KEY'; // 25
    case AAAA = 'AAAA'; // 28
    case LOC = 'LOC'; // 29
    case SRV = 'SRV'; // 33
    case NAPTR = 'NAPTR'; // 35
    case KX = 'KX'; // 36
    case CERT = 'CERT'; // 37
    case DNAME = 'DNAME'; // 39
    case APL = 'APL'; // 42

    public function getReference(): string
    {
        return match ($this) {
            self::A, self::NS, self::CNAME, self::PTR, self::TXT => RequestForComment::RFC_1035->value,
            self::SOA => sprintf('%s and %s', RequestForComment::RFC_1035->value, RequestForComment::RFC_2308->value),
            self::HINFO => RequestForComment::RFC_8482->value,
            self::MX => sprintf('%s and %s', RequestForComment::RFC_1035->value, RequestForComment::RFC_7505->value),
            self::RP, self::AFSDB => RequestForComment::RFC_1183->value,
            self::SIG => RequestForComment::RFC_2535->value,
            self::KEY => sprintf('%s and %s', RequestForComment::RFC_2535->value, RequestForComment::RFC_2930->value),
            self::AAAA => RequestForComment::RFC_3596->value,
            self::LOC => RequestForComment::RFC_1876->value,
            self::SRV => RequestForComment::RFC_2782->value,
            self::NAPTR => RequestForComment::RFC_3403->value,
            self::KX => RequestForComment::RFC_2230->value,
            self::CERT => RequestForComment::RFC_4398->value,
            self::DNAME => RequestForComment::RFC_6672->value,
            self::APL => RequestForComment::RFC_3123->value,
        };
    }
}