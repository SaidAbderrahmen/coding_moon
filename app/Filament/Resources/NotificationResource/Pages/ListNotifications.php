<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\NotificationResource;

class ListNotifications extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = NotificationResource::class;
}
