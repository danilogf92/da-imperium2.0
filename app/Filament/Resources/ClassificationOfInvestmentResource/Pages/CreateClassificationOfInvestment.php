<?php

namespace App\Filament\Resources\ClassificationOfInvestmentResource\Pages;

use App\Filament\Resources\ClassificationOfInvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClassificationOfInvestment extends CreateRecord
{
    protected static string $resource = ClassificationOfInvestmentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
