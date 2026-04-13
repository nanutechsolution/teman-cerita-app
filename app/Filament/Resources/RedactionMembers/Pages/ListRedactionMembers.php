<?php

namespace App\Filament\Resources\RedactionMembers\Pages;

use App\Filament\Resources\RedactionMembers\RedactionMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRedactionMembers extends ListRecords
{
    protected static string $resource = RedactionMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
