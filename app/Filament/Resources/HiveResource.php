<?php

namespace App\Filament\Resources;

use App\Models\Hive;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\HiveResource\Pages;

class HiveResource extends Resource
{
    protected static ?string $model = Hive::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'tempreture';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('number')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Number')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('total_bees')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Total Bees')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('present_bees')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Present Bees')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('infected_bees')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Infected Bees')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('tempreture')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Tempreture')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('humidity')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Humidity')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('status')
                        ->rules(['in:working,down'])
                        ->required()
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

                    Select::make('beekeeper_id')
                        ->rules(['exists:beekeepers,id'])
                        ->required()
                        ->relationship('beekeeper', 'name')
                        ->searchable()
                        ->placeholder('Beekeeper')
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
                Tables\Columns\TextColumn::make('number')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('total_bees')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('present_bees')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('infected_bees')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('tempreture')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('humidity')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'working' => 'Working',
                        'down' => 'Down',
                    ]),
                Tables\Columns\TextColumn::make('beekeeper.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('beekeeper_id')
                    ->relationship('beekeeper', 'name')
                    ->indicator('Beekeeper')
                    ->multiple()
                    ->label('Beekeeper'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            HiveResource\RelationManagers\HistoriesRelationManager::class,
            HiveResource\RelationManagers\NotificationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHives::route('/'),
            'create' => Pages\CreateHive::route('/create'),
            'view' => Pages\ViewHive::route('/{record}'),
            'edit' => Pages\EditHive::route('/{record}/edit'),
        ];
    }
}
