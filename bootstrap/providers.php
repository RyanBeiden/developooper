<?php

use App\Providers\AppServiceProvider;
use App\Providers\ArtifactsServiceProvider;
use App\Providers\Filament\ArtifactsPanelProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HorizonServiceProvider;

return [
    AppServiceProvider::class,
    ArtifactsServiceProvider::class,
    ArtifactsPanelProvider::class,
    FortifyServiceProvider::class,
    HorizonServiceProvider::class,
];
