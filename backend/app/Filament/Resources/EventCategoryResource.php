<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventCategoryResource\Pages;
use App\Filament\Resources\EventCategoryResource\RelationManagers;
use App\Models\EventCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class EventCategoryResource extends Resource
{
    protected static ?string $model = EventCategory::class;
    protected static ?string $navigationGroup = 'Events';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->label('Parent Category')
                    ->relationship('parent', 'name', function (Builder $query){
                        return $query->whereNull('parent_id');
                    })
                    ->searchable()
                    ->preload()
                    ->placeholder('No Parent Category')
                    ->allowHtml(),

                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', (string) Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->readOnly()
                    ->required(),

                // Icon
                Forms\Components\SpatieMediaLibraryFileUpload::make('icon')
                    ->label('Icon')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('slug')->label('Slug'),
                // Icon column
                Tables\Columns\SpatieMediaLibraryImageColumn::make('icon')->label('Icon')
                    ->conversion('icon')
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventCategories::route('/'),
            'create' => Pages\CreateEventCategory::route('/create'),
            'edit' => Pages\EditEventCategory::route('/{record}/edit'),
        ];
    }
}
