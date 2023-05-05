<?php

namespace App\Enums;

trait EnumToArray
{

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(),self::values());
    }

}

enum RepeatTimeEnum:string
{
    use EnumToArray;
    case Daily = "daily";
    case Weekly = "weekly";
    case Monthly = "monthly";
    case Yearly = "yearly";
}
