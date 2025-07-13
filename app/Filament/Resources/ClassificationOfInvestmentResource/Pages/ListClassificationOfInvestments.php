<?php

namespace App\Filament\Resources\ClassificationOfInvestmentResource\Pages;

use App\Filament\Resources\ClassificationOfInvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassificationOfInvestments extends ListRecords
{
    protected static string $resource = ClassificationOfInvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
