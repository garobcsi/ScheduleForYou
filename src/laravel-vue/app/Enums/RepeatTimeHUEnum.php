<?php

namespace App\Enums;

use App\Trait\EnumToArray;

enum RepeatTimeHUEnum:string
{
    use EnumToArray;
    case Naponta = "daily";
    case Hetente = "weekly";
    case Hónaponta = "monthly";
    case Évente = "yearly";
}
