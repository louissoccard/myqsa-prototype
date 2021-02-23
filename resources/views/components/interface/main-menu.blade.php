<div>
    <x-interface.menu-item active="{{ request()->routeIs('dashboard') }}" href="{{ route('dashboard') }}"
                           icon="layout">Dashboard
    </x-interface.menu-item>
    <x-interface.menu-item active="{{ request()->routeIs('award') }}" href="{{ route('award') }}" icon="award">Award
    </x-interface.menu-item>
    <x-interface.menu-item href="#" icon="users">My District</x-interface.menu-item>
    <x-interface.menu-item active="{{ request()->routeIs('admin.*') }}" href="{{ route('admin.show') }}" icon="grid">
        Admin
    </x-interface.menu-item>
</div>
