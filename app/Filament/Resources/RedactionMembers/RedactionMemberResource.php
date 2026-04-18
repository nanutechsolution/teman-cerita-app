<?php

namespace App\Filament\Resources\RedactionMembers;

use App\Enums\NavigationGroup;
use App\Filament\Resources\RedactionMembers\Pages\CreateRedactionMember;
use App\Filament\Resources\RedactionMembers\Pages\EditRedactionMember;
use App\Filament\Resources\RedactionMembers\Pages\ListRedactionMembers;
use App\Filament\Resources\RedactionMembers\Pages\ViewRedactionMember;
use App\Filament\Resources\RedactionMembers\Schemas\RedactionMemberForm;
use App\Filament\Resources\RedactionMembers\Schemas\RedactionMemberInfolist;
use App\Filament\Resources\RedactionMembers\Tables\RedactionMembersTable;
use App\Models\RedactionMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RedactionMemberResource extends Resource
{
    protected static ?string $model = RedactionMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Anggota Redaksi';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::SETTINGS->value;
    }

    public static function form(Schema $schema): Schema
    {
        return RedactionMemberForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RedactionMemberInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RedactionMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRedactionMembers::route('/'),
            'create' => CreateRedactionMember::route('/create'),
            'view' => ViewRedactionMember::route('/{record}'),
            'edit' => EditRedactionMember::route('/{record}/edit'),
        ];
    }
}
