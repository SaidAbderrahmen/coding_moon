<?php

namespace App\Filament\Resources\BeekeeperResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\BeekeeperResource;

class ListBeekeepers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BeekeeperResource::class;
}
