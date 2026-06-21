<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\ArtifactsPanelProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HorizonServiceProvider;

return [
    AppServiceProvider::class,
    ArtifactsPanelProvider::class,
    FortifyServiceProvider::class,
    HorizonServiceProvider::class,
];
