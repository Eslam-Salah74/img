<?php

namespace App\Filament\Resources\OurTripResource\Pages;

use App\Filament\Resources\OurTripResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOurTrips extends ManageRecords
{
    protected static string $resource = OurTripResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
