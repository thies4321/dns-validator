<?php

declare(strict_types=1);

namespace DnsValidator\Enum;

enum ResourceRecordType
{
    case A; // 1 - RFC 1035
    case NS; // 2 - RFC 1035
    case CNAME; // 5 - RFC 1035
    case SOA; // 6 - RFC 1035/2308
    case PTR; // 12 - RFC 1035
    case HINFO; // 13 - RFC 8482
    case MX; // 15 - RFC 1035/7505
    case TXT; // 16 - RFC 1035
    case RP; // 17 - RFC 1183
    case AFSDB; // 18 - RFC 1183
    case SIG; // 24 - RFC 2535
    case KEY; // 25 - RFC 2535/2930
    case AAAA; // 28 - RFC 3596
    case LOC; // 29 - RFC 1876
    case SRV; // 33 - RFC 2782
    case NAPTR; // 35 - RFC 3403
    case KX; // 36 - RFC 2230
    case CERT; // 37 - RFC 4398
    case DNAME; // 39 - RFC 6672
    case APL; // 42 - RFC 3123
    case DS; // 43 - RFC 4034
    case SSHFP; // 44 - RFC 4255
    case IPSECKEY; // 45 - RFC 4025
    case RRSIG; // 46 - RFC 4034
    case NSEC; // 47 - RFC 4034
    case DNSKEY; // 48 - RFC 4034
    case DHCID; // 49 - RFC 4701
    case NSEC3; // 50 - RFC 5155
    case NSEC3PARAM; // 51 - RFC 5155
    case TLSA; // 52 - RFC 6698
    case SMIMEA; // 53 - RFC 8162
    case HIP; // 55 - RFC 8005
    case CDS; // 59 - RFC 7344
    case CDNSKEY; // 60 - RFC 7344
    case OPENPGPKEY; // 61 - RFC 7929
    case CSYNC; // 62 - RFC 7477
    case ZONEMD; // 63 - RFC 8976
    case SVCB; // 64 - RFC IN DRAFT (https://datatracker.ietf.org/doc/draft-ietf-dnsop-svcb-https/)
    case HTTPS; // 65 - RFC IN DRAFT (https://datatracker.ietf.org/doc/draft-ietf-dnsop-svcb-https/)
    case EUI48; // 108 - RFC 7043
    case EUI64; // 109 - RFC 7043
    case TKEY; // 249 - RFC 2930
    case TSIG; // 250 - RFC 2845
    case URI; // 256 - RFC 7553
    case CAA; // 257 - RFC 6844
    case TA; // 32768 - RFC UNKNOWN
    case DLV; // 32769 - RFC 4431
}
