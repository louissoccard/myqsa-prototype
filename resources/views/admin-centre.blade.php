<x-app-layout>
    <x-slot name="title">Admin Centre</x-slot>

    <h2>Admin Centre</h2>
    <p class="mb-4">Welcome to the admin centre, {{ Auth::user()->first_name }}.</p>

    <div class="flex flex-row flex-wrap">
        {{-- Row 1 --}}
        <x-admin-centre.menu-item icon="users" class="mb-4 md:pr-2" href="{{ route('admin-centre.accounts') }}">
            Accounts
        </x-admin-centre.menu-item>
        <x-admin-centre.menu-item icon="map-pin" class="mb-4 md:pl-2 lg:px-1"
                                  href="{{ route('admin-centre.districts') }}">Districts
        </x-admin-centre.menu-item>
        <x-admin-centre.menu-item icon="map" class="mb-4 md:pr-2 lg:pr-0 lg:pl-2"
                                  href="{{ route('admin-centre.clusters') }}">
            Clusters
        </x-admin-centre.menu-item>

        {{-- Row 2 --}}
        <x-admin-centre.menu-item icon="list" class="mb-4 md:pr-2" href="{{ route('admin-centre.changelog') }}">
            Changelog
        </x-admin-centre.menu-item>
        <x-admin-centre.menu-item icon="key" class="mb-4 md:pl-2 lg:px-1"
                                  href="{{ route('admin-centre.permissions') }}">Permissions
        </x-admin-centre.menu-item>
        <x-admin-centre.menu-item icon="user-check" class="mb-4 md:pr-2 lg:pr-0 lg:pl-2"
                                  href="{{ route('admin-centre.roles') }}">
            Roles
        </x-admin-centre.menu-item>
    </div>
</x-app-layout>
