<?php
namespace App\Consts;

use Filament\Support\Contracts\HasLabel;

enum EventVisibility: int implements HasLabel
{
    use ConstTrait;

    case PUBLIC = 0;
    case PRIVATE = 1;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLIC => 'Public',
            self::PRIVATE => 'Private',
        };
    }
}
