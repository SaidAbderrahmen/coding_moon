<?php

namespace App\Filament\Resources\BeekeeperResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class HivesRelationManager extends RelationManager
{
    protected static string $relationship = 'hives';

    protected static ?string $recordTitleAttribute = 'tempreture';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('number')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Number')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('total_bees')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Total Bees')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('present_bees')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Present Bees')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('infected_bees')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Infected Bees')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('tempreture')
                    ->rules(['string'])
                    ->placeholder('Tempreture')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('humidity')
                    ->rules(['string'])
                    ->placeholder('Humidity')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('status')
                    ->rules(['in:working,down'])
                    ->searchable()
                    ->options([
                        'working' => 'Working',
                        'down' => 'Down',
                    ])
                    ->placeholder('Status')
                    ->default('working')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('total_bees'),
                Tables\Columns\TextColumn::make('present_bees'),
                Tables\Columns\TextColumn::make('infected_bees'),
                Tables\Columns\TextColumn::make('tempreture')->limit(50),
                Tables\Columns\TextColumn::make('humidity')->limit(50),
                Tables\Columns\TextColumn::make('status')->enum([
                    'working' => 'Working',
                    'down' => 'Down',
                ]),
                Tables\Columns\TextColumn::make('beekeeper.name')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('beekeeper_id')->relationship(
                    'beekeeper',
                    'name'
                ),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
