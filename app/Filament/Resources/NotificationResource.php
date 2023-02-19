<?php

namespace App\Filament\Resources;

use App\Models\Notification;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\NotificationResource\Pages;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'details';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('event')
                        ->rules([
                            'in:infected bee,hornet detected,temperature change',
                        ])
                        ->required()
                        ->searchable()
                        ->options([
                            'infected bee' => 'Infected bee',
                            'hornet detected' => 'Hornet detected',
                            'temperature change' => 'Temperature change',
                        ])
                        ->placeholder('Event')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('details')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Details')
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

                    DatePicker::make('date')
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
                Tables\Columns\TextColumn::make('event')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'infected bee' => 'Infected bee',
                        'hornet detected' => 'Hornet detected',
                        'temperature change' => 'Temperature change',
                    ]),
                Tables\Columns\TextColumn::make('details')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('hive.tempreture')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('date')
                    ->toggleable()
                    ->date(),
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'view' => Pages\ViewNotification::route('/{record}'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
