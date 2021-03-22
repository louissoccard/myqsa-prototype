<x-app-layout>
    <x-slot name="title">Admin Centre</x-slot>

    <h2 class="text-2xl font-black">Admin Centre</h2>
    <p class="mb-4">Welcome to the admin centre, {{ Auth::user()->first_name }}.</p>

    <div class="flex flex-row flex-wrap">
        <x-admin.menu-item icon="users" class="mb-4 md:pr-2" href="{{ route('admin.accounts') }}">
            Accounts
        </x-admin.menu-item>
        <x-admin.menu-item icon="map-pin" class="mb-4 md:pl-2 lg:px-1" href="{{ route('admin.districts') }}">Districts
        </x-admin.menu-item>
        <x-admin.menu-item icon="map" class="mb-4 md:pr-2 lg:pr-0 lg:pl-2" href="{{ route('admin.clusters') }}">
            Clusters
        </x-admin.menu-item>
        <x-admin.menu-item icon="zap" class="md:pl-2 lg:pl-0 lg:pr-2">What's new?</x-admin.menu-item>
    </div>
</x-app-layout>
