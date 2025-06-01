<?php
namespace App\Consts;
enum UserSource : string{
    use ConstTrait;

    case DEFAULT = 'default';
    case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
}
