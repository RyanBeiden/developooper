<x-layouts::app.sidebar :title="$title ?? null">
    @if(isset($subnav))
        {{ $subnav }}
    @endif

    <flux:main>{{ $slot }}</flux:main>
</x-layouts::app.sidebar>
