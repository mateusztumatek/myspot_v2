<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AttendeesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendees';

    protected function configureCreateAction(Tables\Actions\CreateAction $action): void
    {
        parent::configureCreateAction($action);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('attendee_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('attendee_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('attendee_phone')
                    ->tel()
                    ->maxLength(20),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('attendee_name')
            ->columns([
                Tables\Columns\TextColumn::make('attendee_name'),
                Tables\Columns\TextColumn::make('attendee_email')
                    ->label('Email'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->beforeFormFilled(function (Tables\Actions\CreateAction $createAction){
                    /**
                     * @var Event $event
                     */
                    $event = $this->getOwnerRecord();
                    if ($event->max_attendees && $event->attendees()->count() >= $event->max_attendees) {
                        Notification::make()
                            ->title('Attendee limit reached')
                            ->body("You cannot add more than {$event->max_attendees} attendees to this event.")
                            ->danger()
                            ->send();

                        $createAction->cancel();
                    }
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
