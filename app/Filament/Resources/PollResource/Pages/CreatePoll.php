<?php

namespace App\Filament\Resources\PollResource\Pages;

use App\Filament\Resources\PollResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePoll extends CreateRecord
{
    protected static string $resource = PollResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['poll_creator_id'] = Auth::id();
        return $data;
    }
}
