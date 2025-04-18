<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use App\Models\Classroom;
use App\Models\Periode;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ClassroomRelationManager extends RelationManager
{
    protected static string $relationship = 'classroom';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classrooms_id')
                    ->relationship('classroom', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->afterStateUpdated( fn ( Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\Hidden::make('slug'),
                    ])
                    ->createOptionAction(
                        function (Action $action) {
                            return $action
                            ->label(label: 'Create Classroom')
                            ->modalHeading('Create Classroom');
                        }
                    )
                    ->label('Classroom')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('periode_id')
                    ->relationship('periode', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->afterStateUpdated( fn ( Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    ])
                    ->createOptionAction(
                        function (Action $action) {
                            return $action
                            ->label(label: 'Create Periode')
                            ->modalHeading('Create Periode');
                        }
                    )
                    ->label('Periode')
                    ->options(Periode::all()->pluck('name', 'id'))
                    ->searchable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('classroom.name'),
                Tables\Columns\TextColumn::make('periode.name'),
                Tables\Columns\ToggleColumn::make('is_open'),
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
