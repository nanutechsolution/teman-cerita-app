<?php

namespace App\Filament\Resources\Episodes;

use App\Enums\NavigationGroup;
use App\Filament\Resources\Episodes\Pages\CreateEpisode;
use App\Filament\Resources\Episodes\Pages\EditEpisode;
use App\Filament\Resources\Episodes\Pages\ListEpisodes;
use App\Filament\Resources\Episodes\Pages\ViewEpisode;
use App\Filament\Resources\Episodes\Schemas\EpisodeForm;
use App\Filament\Resources\Episodes\Schemas\EpisodeInfolist;
use App\Filament\Resources\Episodes\Tables\EpisodesTable;
use App\Models\Episode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMicrophone;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Daftar Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?int $navigationSort = 1;
    public static function getNavigationGroup(): ?string
    {

        return NavigationGroup::CONTENT->value;
    }
    public static function form(Schema $schema): Schema
    {
        return EpisodeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EpisodeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EpisodesTable::configure($table);
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
            'index' => ListEpisodes::route('/'),
            // 'create' => CreateEpisode::route('/create'),
            'view' => ViewEpisode::route('/{record}'),
            'edit' => EditEpisode::route('/{record}/edit'),
        ];
    }
}
