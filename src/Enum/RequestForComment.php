<?php

declare(strict_types=1);

namespace DnsValidator\Enum;

enum RequestForComment: string
{
    case RFC_1035 = 'RFC 1035';
    case RFC_1183 = 'RFC 1183';
    case RFC_1876 = 'RFC 1876';
    case RFC_2230 = 'RFC 2230';
    case RFC_2308 = 'RFC 2308';
    case RFC_2535 = 'RFC 2535';
    case RFC_2782 = 'RFC 2782';
    case RFC_2845 = 'RFC 2845';
    case RFC_2930 = 'RFC 2930';
    case RFC_3123 = 'RFC 3123';
    case RFC_3403 = 'RFC 3403';
    case RFC_3596 = 'RFC 3596';
    case RFC_4025 = 'RFC 4025';
    case RFC_4034 = 'RFC 4034';
    case RFC_4255 = 'RFC 4255';
    case RFC_4398 = 'RFC 4398';
    case RFC_4431 = 'RFC 4431';
    case RFC_4701 = 'RFC 4701';
    case RFC_5155 = 'RFC 5155';
    case RFC_6672 = 'RFC 6672';
    case RFC_6698 = 'RFC 6698';
    case RFC_6844 = 'RFC 6844';
    case RFC_7043 = 'RFC 7043';
    case RFC_7344 = 'RFC 7344';
    case RFC_7477 = 'RFC 7477';
    case RFC_7505 = 'RFC 7505';
    case RFC_7553 = 'RFC 7553';
    case RFC_7929 = 'RFC 7929';
    case RFC_8005 = 'RFC 8005';
    case RFC_8162 = 'RFC 8162';
    case RFC_8482 = 'RFC 8482';
    case RFC_8976 = 'RFC 8976';
    case RFC_IN_DRAFT = 'RFC in draft';
    case RFC_UNKNOWN = 'RFC unknown';
}