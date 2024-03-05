<?php

namespace Polntantos\AnnotationPlugin;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Polntantos\AnnotationPlugin\AnnotationPlugin;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AnnotationPluginServiceProvider extends PackageServiceProvider
{
    public static string $name = 'annotation-plugin';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        Livewire::component('annotation-plugin', AnnotationPlugin::class);

        FilamentAsset::register(
            assets: [
                AlpineComponent::make('annotation-plugin', __DIR__ . '/../resources/dist/annotation-plugin.js'),
            ],
            package: 'polntantos/annotation-plugin'
        );
    }
}
