<x-layouts::app :title="'Artifacts' . (isset($title) ? ' - ' . $title : '')">
    <div>
        <x-slot:subnav>
            <livewire:artifacts::sub-nav />
        </x-slot>

        <div>{{ $slot }}</div>
    </div>
</x-layouts::app>
