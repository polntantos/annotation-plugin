@php
$id = $getId();
$isDisabled = $isDisabled();
$name = $getName();
$config = $getConfig();
$interfaces = $getInterfaces();
$user = $getUser();
$task = $getTask();
@endphp
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <link href="https://unpkg.com/@heartexlabs/label-studio@1.4.0/build/static/css/main.css" rel="stylesheet">

    <div x-ignore ax-load ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('annotation-plugin', 'polntantos/annotation-plugin') }}" x-data="annotationPlugin({
        state: $wire.$entangle('{{ $getStatePath() }}'),
        config: @js($config),
        name: $refs.labelstudio,
        interfaces: @js($interfaces),
        user: {{$user}},
        task: {{$task}}
    })">

        <div x-ref="labelstudio" class="w-full" style="min-height: 30vh; z-index: 1 !important;">
        </div>

    </div>
</x-dynamic-component>