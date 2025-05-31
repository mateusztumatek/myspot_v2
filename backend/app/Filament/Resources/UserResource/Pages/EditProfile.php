<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Consts\Locale;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Spatie\Image\Enums\Fit;

class EditProfile extends BaseEditProfile
{
    protected static string $resource = UserResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                Select::make('locale')
                    ->options(Locale::class)
                    ->enum(Locale::class),
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->id('avatar')
                    ->collection('avatar')
                    ->image()
                    ->conversion('thumb')
                    ->maxSize(1024 * 2),
            ]);
    }
}
