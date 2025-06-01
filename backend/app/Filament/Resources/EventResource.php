<?php

namespace App\Filament\Resources;

use App\Consts\EventUserVisibilityPolicy;
use App\Consts\EventVisibility;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use App\Models\EventCategory;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationGroup = 'Events';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Event Details')
                    ->description('Configure the basic details of the event.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description'),
                        // Category
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name', function (Builder $query){
                                $query->whereNotNull('event_categories.parent_id');
                            })
                            ->getOptionLabelFromRecordUsing(function (EventCategory $category) {
                                return view('filament.resources.event-category.option-label', [
                                    'category' => $category,
                                ])->render();
                            })
                            ->searchable()
                            ->preload()
                            ->placeholder('No Category')
                            ->required()
                            ->allowHtml(),
                        // Images for this event
                        Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                            ->collection('images')
                            ->label('Event Images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->maxFiles(5),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Event Location')
                    ->description('Set the location and time for the event.')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\DateTimePicker::make('start_at')
                                ->label('Start Time')
                                ->seconds(false)
                                ->required(),

                            Forms\Components\DateTimePicker::make('end_at')
                                ->label('End Time')
                                ->seconds(false)
                                // Validate after start_at
                                ->nullable()
                                ->after('start_at'),
                        ]),

                        Forms\Components\TextInput::make('location_name')
                            ->maxLength(255)
                            ->nullable(),

                        Map::make('location')
                            ->autocomplete(
                                fieldName: 'location_name',
                                types: ['establishment'],
                                placeField: 'name',
                                countries: ['PL'],
                            ),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Event Sign-up options')
                    ->description('Configure how users can sign up for this event.')
                    ->schema([
                        Forms\Components\Radio::make('visibility')
                            ->options(EventVisibility::class)
                            ->hint('Public events are visible to all users, while private events are only visible to invited users (Users who have the link).')
                            ->enum(EventVisibility::class),
                        Forms\Components\TextInput::make('max_attendees')
                            ->label('Maximum Attendees')
                            ->numeric()
                            ->nullable()
                            ->minValue(1)
                            ->helperText('Leave empty for unlimited attendees.')
                            ->live(500),
                        // Time for sign-up
                        Forms\Components\DateTimePicker::make('sign_up_until')
                            ->label('Sign-up Deadline')
                            ->seconds(false)
                            ->nullable()
                            ->helperText('Leave empty for no deadline.'),

                        Forms\Components\Select::make('user_visibility')
                            ->label('User Visibility Policy')
                            ->options(EventUserVisibilityPolicy::class)
                            ->enum(EventUserVisibilityPolicy::class)
                            ->helperText('Choose who can see the list of users signed up for this event.'),

                    ])
                    ->columns(1),

                Forms\Components\Section::make('Event Payment')
                    ->description('Configure payment options for this event.')
                    ->disabled()
                    ->schema([
                        Forms\Components\Checkbox::make('paid')
                            ->label('Paid Event')
                            ->default(false)
                            ->reactive()
                            ->helperText('Check if this event requires payment to attend.'),

                        Forms\Components\TextInput::make('payment_details.price')
                            ->label('Event Price')
                            ->numeric()
                            ->live(500)
                            ->visible(fn (callable $get) => $get('paid')),

                        Forms\Components\Select::make('payment_details.payment_type')
                            ->label('Payment Type')
                            ->options([
                                'credit_card' => 'Credit Card',
                                'paypal' => 'PayPal',
                                'cash' => 'Cash',
                            ])
                            ->live(500)
                            ->visible(fn (callable $get) => $get('paid')),

                        Forms\Components\Textarea::make('payment_details.return_policy')
                            ->label('Return Policy')
                            ->live(500)
                            ->visible(fn (callable $get) => $get('paid')),
                ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('location_name'),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime('Y-m-d H:i'),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime('Y-m-d H:i'),
                Tables\Columns\TextColumn::make('visibility')
                    ->formatStateUsing(fn(int $state) => EventVisibility::from($state)->getLabel())
                    ->badge()
                    ->colors([
                        'primary' => EventVisibility::PUBLIC,
                        'secondary' => EventVisibility::PRIVATE,
                    ]),

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
            RelationManagers\AttendeesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
