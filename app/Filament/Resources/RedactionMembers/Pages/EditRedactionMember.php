<?php

namespace App\Filament\Resources\RedactionMembers\Pages;

use App\Filament\Resources\RedactionMembers\RedactionMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRedactionMember extends EditRecord
{
    protected static string $resource = RedactionMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
