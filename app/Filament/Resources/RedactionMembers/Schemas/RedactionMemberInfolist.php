<?php

namespace App\Filament\Resources\RedactionMembers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RedactionMemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Detail Anggota Redaksi')
                    ->schema([
                        ImageEntry::make('photo')
                            ->label('Foto')
                            ->circular() // Mengikuti format dari tabel
                            ->defaultImageUrl(url('/images/placeholder.png'))
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label('Nama'),

                        TextEntry::make('position')
                            ->label('Jabatan'),

                        TextEntry::make('group')
                            ->label('Grup')
                            ->badge() // Menggunakan format badge berwarna dari tabel
                            ->color(fn (string $state): string => match ($state) {
                                'pimpinan' => 'danger',
                                'editorial' => 'success',
                                'it_sosmed' => 'info',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pimpinan' => 'Pimpinan',
                                'editorial' => 'Editorial',
                                'it_sosmed' => 'IT & Sosial Media',
                                default => $state,
                            }),

                        TextEntry::make('sort_order')
                            ->label('Urutan')
                            ->numeric(),

                        IconEntry::make('is_active')
                            ->label('Status Aktif')
                            ->boolean(),

                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2) // Membuat layout 2 kolom seperti pada form
            ]);
    }
}
