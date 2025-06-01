<?php
namespace App\Consts;

use Filament\Support\Contracts\HasLabel;

enum EventUserVisibilityPolicy: string implements HasLabel
{
    use ConstTrait;
    case VISIBLE_EACH_OTHER = 'visible_each_other';
    case VISIBLE_ONLY_ADMIN = 'visible_only_admin';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::VISIBLE_EACH_OTHER => 'Visible to each other',
            self::VISIBLE_ONLY_ADMIN => 'Visible only to admin',
        };
    }
}
