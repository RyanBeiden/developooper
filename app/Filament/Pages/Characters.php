<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Characters extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.characters';

    protected static string|null|\BackedEnum $navigationIcon = 'fluentui-people-queue-20';

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $characters = [];

    public function mount(): void
    {
        try {
            $response = \Http::withToken(config('artifacts.token'))
                ->get('https://api.artifactsmmo.com/my/characters');

            $this->characters = $response->successful() ? $response->json('data') : [];
        } catch (\Exception $e) {
            $this->characters = [];
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(fn () => $this->characters)
            ->columns([
                TextColumn::make('name')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('skin')
                    ->label('Class'),

                TextColumn::make('level')
                    ->badge()
                    ->color('info'),

                TextColumn::make('gold')
                    ->numeric()
                    ->icon('heroicon-o-currency-dollar'),
            ])
            ->searchable(false);
    }
}
