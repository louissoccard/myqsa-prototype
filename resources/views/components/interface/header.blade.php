<header
    class="fixed top-0 left-0 right-0 z-30 h-16 py-4 bg-gray-50 dark:bg-gray-800 shadow-sm border-b border-transparent dark:border-gray-700">
    <div class="flex items-center justify-between h-full px-6 mx-auto text-grey-80 dark:text-grey-5">
        <a href="{{ route('dashboard') }}">
            <x-interface.logo width="w-24"></x-interface.logo>
        </a>
        <div class="flex items-center flex-shrink-0">

            {{-- User Dropdown --}}
            <div class="hidden md:inline">
                <x-utilities.dropdown width="w-72" var="isUserDropdownOpen">
                    <x-slot name="trigger">
                        <button class="align-middle ml-6 focus:shadow-outline-purple focus:outline-none"
                                aria-label="Account" aria-haspopup="true">
                            <x-utilities.icon class="inline">user</x-utilities.icon>
                            <x-utilities.icon class="inline" size="16">chevron-down</x-utilities.icon>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-interface.accounts-menu></x-interface.accounts-menu>
                    </x-slot>
                </x-utilities.dropdown>
            </div>

            {{-- User Menu --}}
            <button class="align-middle ml-4 md:hidden focus:outline-none focus:shadow-outline-purple"
                    x-show="!isUserMenuOpen && !isSideMenuOpen"
                    @click="isUserMenuOpen = !isUserMenuOpen; isSideMenuOpen = false" aria-label="Account">
                <x-utilities.icon>user</x-utilities.icon>
            </button>

            {{-- Mobile Hamburger --}}
            <button class="align-middle ml-4 md:hidden focus:outline-none focus:shadow-outline-purple"
                    x-show="!isUserMenuOpen && !isSideMenuOpen"
                    @click="isSideMenuOpen = !isSideMenuOpen; isUserMenuOpen = false" aria-label="Menu">
                <x-utilities.icon>menu</x-utilities.icon>
            </button>

            {{-- Close Menu --}}
            <button class="align-middle ml-4 md:hidden focus:outline-none focus:shadow-outline-purple"
                    x-show="isUserMenuOpen || isSideMenuOpen"
                    @click="isSideMenuOpen = false; isUserMenuOpen = false" aria-label="Menu">
                <x-utilities.icon>x</x-utilities.icon>
            </button>
        </div>
    </div>
</header>
