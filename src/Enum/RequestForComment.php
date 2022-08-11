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
    case RFC_2930 = 'RFC 2930';
    case RFC_3123 = 'RFC 3123';
    case RFC_3403 = 'RFC 3403';
    case RFC_3596 = 'RFC 3596';
    case RFC_4398 = 'RFC 4398';
    case RFC_6672 = 'RFC 6672';
    case RFC_7505 = 'RFC 7505';
    case RFC_8482 = 'RFC 8482';
}