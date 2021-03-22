<x-app-layout>
    <x-slot name="title">Clusters - Admin</x-slot>

    <h2 class="text-2xl font-bold mb-4">
        <a href="{{ route('admin.show') }}" class="hover:text-blue">Admin</a>
        / <span class="font-black">Clusters</span>
    </h2>

    @livewire('admin.clusters.table')

</x-app-layout>

