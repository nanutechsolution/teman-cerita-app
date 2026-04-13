<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Profil')
                    ->description('Kelola detail identitas dan akses akun pengguna.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),
                        ]),


                        Grid::make(2)->schema([
                            // Integrasi Filament Shield: Pemilihan Role
                            Select::make('roles')
                                ->label('Peran (Roles)')
                                ->helperText('Tentukan hak akses pengguna ini sesuai kebijakan redaksi.')
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->required(),
                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->password()
                                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                ->dehydrated(fn($state) => filled($state))
                                ->required(fn(string $context): bool => $context === 'create')
                                ->helperText('Kosongkan jika tidak ingin mengubah kata sandi saat mengedit.')
                                ->maxLength(255),
                        ]),
                        FileUpload::make('profile_photo_path')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->directory('profile-photos')
                            ->visibility('public')
                            ->helperText('Gunakan rasio 1:1 untuk hasil terbaik. Foto ini akan muncul di samping artikel berita.'),
                    ]),
            ]);
    }
}
