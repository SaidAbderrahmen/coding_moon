<?php

namespace App\Filament\Resources\TipResource\Pages;

use App\Filament\Resources\TipResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListTips extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TipResource::class;
}
