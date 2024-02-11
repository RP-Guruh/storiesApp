<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;
use Auth;

class CreatePhoto extends CreateRecord
{
    protected static string $resource = PhotoResource::class;

}
