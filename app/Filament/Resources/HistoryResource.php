<?php

namespace App\Filament\Resources;

use App\Models\History;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\HistoryResource\Pages;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('action')
                        ->rules(['in:spray,sound,manual'])
                        ->required()
                        ->searchable()
                        ->options([
                            'spray' => 'Spray',
                            'sound' => 'Sound',
                            'manual' => 'Manual',
                        ])
                        ->placeholder('Action')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('hive_id')
                        ->rules(['exists:hives,id'])
                        ->required()
                        ->relationship('hive', 'tempreture')
                        ->searchable()
                        ->placeholder('Hive')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('action')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'spray' => 'Spray',
                        'sound' => 'Sound',
                        'manual' => 'Manual',
                    ]),
                Tables\Columns\TextColumn::make('hive.tempreture')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('date')
                    ->toggleable()
                    ->dateTime(),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('hive_id')
                    ->relationship('hive', 'tempreture')
                    ->indicator('Hive')
                    ->multiple()
                    ->label('Hive'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistories::route('/'),
            'create' => Pages\CreateHistory::route('/create'),
            'view' => Pages\ViewHistory::route('/{record}'),
            'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}
