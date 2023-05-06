<?php

namespace App\Enums;

trait EnumToArrayHU
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
        $arr = array();
        foreach (self::names() as $n => $i) {
            $arr[] = [
                "name" => $i,
                "value" => self::values()[$n]
            ];
        }
        return $arr;
    }

}

enum RepeatTimeHUEnum:string
{
    use EnumToArrayHU;
    case Naponta = "daily";
    case Hetente = "weekly";
    case Hónaponta = "monthly";
    case Évente = "yearly";
}
