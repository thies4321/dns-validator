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
    case DS = 'DS'; // 43
    case SSHFP = 'SSHFP'; // 44
    case IPSECKEY = 'IPSECKEY'; // 45
    case RRSIG = 'RRSIG'; // 46
    case NSEC = 'NSEC'; // 47
    case DNSKEY = 'DNSKEY'; // 48
    case DHCID = 'DHCID'; // 49
    case NSEC3 = 'NSEC3'; // 50
    case NSEC3PARAM = 'NSEC3PARAM'; // 51
    case TLSA = 'TLSA'; // 52
    case SMIMEA = 'SMIMEA'; // 53
    case HIP = 'HIP'; // 55
    case CDS = 'CDS'; // 59
    case CDNSKEY = 'CDNSKEY'; // 60
    case OPENPGPKEY = 'OPENPGPKEY'; // 61
    case CSYNC = 'CSYNC'; // 62
    case ZONEMD = 'ZONEMD'; // 63
    case SVCB = 'SVCB'; // 64
    case HTTPS = 'HTTPS'; // 65
    case EUI48 = 'EUI48'; // 108
    case EUI64 = 'EUI64'; // 109
    case TKEY = 'TKEY'; // 249
    case TSIG = 'TSIG'; // 250
    case URI = 'URI'; // 256
    case CAA = 'CAA'; // 257
    case TA = 'TA'; // 32768
    case DLV = 'DLV'; // 32769

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
            self::DS, self::RRSIG, self::NSEC, self::DNSKEY => RequestForComment::RFC_4034->value,
            self::SSHFP => RequestForComment::RFC_4255->value,
            self::IPSECKEY => RequestForComment::RFC_4025->value,
            self::DHCID => RequestForComment::RFC_4701->value,
            self::NSEC3, self::NSEC3PARAM => RequestForComment::RFC_5155->value,
            self::TLSA => RequestForComment::RFC_6698->value,
            self::SMIMEA => RequestForComment::RFC_8162->value,
            self::HIP => RequestForComment::RFC_8005->value,
            self::CDS, self::CDNSKEY => RequestForComment::RFC_7344->value,
            self::OPENPGPKEY => RequestForComment::RFC_7929->value,
            self::CSYNC => RequestForComment::RFC_7477->value,
            self::ZONEMD => RequestForComment::RFC_8976->value,
            self::SVCB, self::HTTPS => RequestForComment::RFC_IN_DRAFT->value,
            self::EUI48, self::EUI64 => RequestForComment::RFC_7043->value,
            self::TKEY => RequestForComment::RFC_2930->value,
            self::TSIG => RequestForComment::RFC_2845->value,
            self::URI => RequestForComment::RFC_7553->value,
            self::CAA => RequestForComment::RFC_6844->value,
            self::TA => RequestForComment::RFC_UNKNOWN->value,
            self::DLV => RequestForComment::RFC_4431->value,
        };
    }
}