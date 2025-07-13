<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Enums\State;
use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Projects'),

            'Planification' => Tab::make('Planification')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->whereHas('state', fn($q) => $q->where('state_name', State::PLANIFICATION->value))
                ),

            'Execution' => Tab::make('Execution')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->whereHas('state', fn($q) => $q->where('state_name', State::EXECUTION->value))
                ),

            'Finished' => Tab::make('Finished')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->whereHas('state', fn($q) => $q->where('state_name', State::FINISHED->value))
                ),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
