<x-filament-forms::field-wrapper>

    <div
        ax-load
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('annotation-plugin', 'polntantos/annotation-plugin') }}"
        x-data="annotationPlugin()"
        >

        <div x-ref="label-studio" class="w-full" style="min-height: 30vh; z-index: 1 !important;">
        </div>

    </div>
</x-filament-forms::field-wrapper>
