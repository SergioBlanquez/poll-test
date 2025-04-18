<?php

namespace App\Filament\Resources\PollResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\QuestionType;
use App\Models\Poll_Question;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'poll_questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options(
                        collect(QuestionType::cases())
                            ->mapWithKeys(fn (QuestionType $type) => [
                                $type->value => $type->label()
                            ])
                    )
                    ->searchable(),
                Forms\Components\Toggle::make('required')
                    ->default(false),
                Forms\Components\Textarea::make('options')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn ($state) => $state instanceof QuestionType ? $state->label() : 'Desconocido'),
                Tables\Columns\IconColumn::make('required')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
