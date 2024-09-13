<?php

namespace App\Filament\Resources\ReviewVideoResource\Pages;

use App\Filament\Resources\ReviewVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageReviewVideos extends ManageRecords
{
    protected static string $resource = ReviewVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
