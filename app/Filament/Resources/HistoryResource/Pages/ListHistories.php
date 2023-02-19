<?php

namespace App\Filament\Resources\HistoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\HistoryResource;

class ListHistories extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = HistoryResource::class;
}
