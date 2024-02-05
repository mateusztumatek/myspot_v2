<?php

namespace App\Consts;

trait ConstTrait{

    /**
     * Constant values as array
     * @return array
     */
    public static function values() : array{
        return array_map(fn($const) => $const->value, self::cases());
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value) : bool{
        return in_array($value, self::values());
    }
}
