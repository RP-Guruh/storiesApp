<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class UserOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            Card::make('All', User::all()->count())
            ->color('success')
            ->extraAttributes([
                'wire:click' => "\$dispatch('filterUpdateAll', { filter: 'role_id' })",
                'class' => 'transition hover:text-primary-500 cursor-pointer',
            ])
            ->description('Increase in users')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),

            Card::make('Admin', User::where('role_id', '2')->count())
            ->color('success')
            ->extraAttributes([
                'wire:click' => "\$dispatch('filterUpdateAdmin', { filter: 'role_id' })",
                'class' => 'transition hover:text-primary-500 cursor-pointer',
            ])
            ->description('Increase in Admin')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('warning')
            ->chart([8,3,2,9,10,3,7,3]),

            Stat::make('Super Admin', User::where('role_id', '1')->count())
            ->extraAttributes([
                'wire:click' => "\$dispatch('filterUpdateSuper', { filter: 'role_id' })",
                'class' => 'transition hover:text-primary-500 cursor-pointer',
            ])
            ->description('Increase in Super Admin')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger')
            ->chart([7,3,4,5,6,3,5,3]),

        ];
    }
}
