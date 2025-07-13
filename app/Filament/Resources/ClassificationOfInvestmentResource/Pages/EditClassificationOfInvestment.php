<?php

namespace App\Filament\Resources\ClassificationOfInvestmentResource\Pages;

use App\Filament\Resources\ClassificationOfInvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassificationOfInvestment extends EditRecord
{
    protected static string $resource = ClassificationOfInvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
