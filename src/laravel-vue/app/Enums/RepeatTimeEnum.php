<?php

namespace App\Enums;

use App\Trait\EnumToArray;

enum RepeatTimeEnum:string
{
    use EnumToArray;
    case Daily = "daily";
    case Weekly = "weekly";
    case Monthly = "monthly";
    case Yearly = "yearly";
}
