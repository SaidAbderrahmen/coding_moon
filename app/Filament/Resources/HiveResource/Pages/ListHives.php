<?php

namespace App\Filament\Resources\HiveResource\Pages;

use App\Filament\Resources\HiveResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListHives extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = HiveResource::class;
}
