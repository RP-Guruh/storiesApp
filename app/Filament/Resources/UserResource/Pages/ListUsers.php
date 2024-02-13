<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected $listeners = [
        'filterUpdateAdmin' => 'updateTableFiltersAdmin',
        'filterUpdateSuper' => 'updateTableFiltersSuper',
        'filterUpdateAll' => 'updateTableFiltersAll',


    ];

    public function updateTableFiltersAdmin(string $filter): void
    {
        $this->tableFilters[$filter]['value'] = '2';
    }

    public function updateTableFiltersSuper(string $filter): void
    {
        $this->tableFilters[$filter]['value'] = '1';
    }

    public function updateTableFiltersAll(string $filter): void
    {
        $this->resetTable();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\UserOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
