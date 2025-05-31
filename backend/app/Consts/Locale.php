<?php
namespace App\Consts;
enum Locale : string{

    use ConstTrait;
    case EN = 'en';
    case PL = 'pl';

    public function getLabel() : ?string
    {
        return match($this) {
            self::EN => 'English',
            self::PL => 'Polish',
        };
    }
}
