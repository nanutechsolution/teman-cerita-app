<?php

namespace App\Filament\Resources\RedactionMembers\Pages;

use App\Filament\Resources\RedactionMembers\RedactionMemberResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRedactionMember extends ViewRecord
{
    protected static string $resource = RedactionMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
