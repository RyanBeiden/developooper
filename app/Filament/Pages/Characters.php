<?php

namespace App\Filament\Pages;

use ArtifactsMmo\Api\MyCharactersApi;
use ArtifactsMmo\Model\CharacterSchema;
use Filament\Notifications\Notification;
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

    protected static ?string $title = 'My Characters';

    public function table(Table $table): Table
    {
        return $table
            ->records(fn () => $this->getCharacters())
            ->columns([
                TextColumn::make('name')
                    ->label('Character Name'),

                TextColumn::make('level')
                    ->badge()
                    ->color('info'),

                TextColumn::make('xp')
                    ->label('Experience')
                    ->formatStateUsing(fn ($state, array $record) => number_format($state).' / '.number_format($record['max_xp'])),

                TextColumn::make('gold')
                    ->numeric()
                    ->icon('heroicon-m-currency-dollar')
                    ->iconColor('warning'),

                TextColumn::make('cooldown')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state > 0 ? "Cooldown ({$state}s)" : 'Idle')
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'primary'),
            ]);
    }

    /**
     * @return CharacterSchema[]
     */
    protected function getCharacters(): array
    {
        try {
            $data = collect(app(MyCharactersApi::class)
                ->getMyCharactersMyCharactersGet()
                ->getData());

            return $data->map(function (CharacterSchema $character) {
                return [
                    'name' => $character->getName(),
                    'level' => $character->getLevel(),
                    'xp' => $character->getXp(),
                    'max_xp' => $character->getMaxXp(),
                    'gold' => $character->getGold(),
                    'cooldown' => $character->getCooldown(),
                ];
            })->toArray();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Could not get characters')
                ->body($e->getMessage())
                ->danger()
                ->duration(10000)
                ->send();

            return [];
        }
    }
}
