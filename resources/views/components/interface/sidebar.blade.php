<!-- Desktop sidebar -->
<aside
    class="z-20 hidden w-64 overflow-y-auto bg-gray-50 dark:bg-gray-800 md:flex flex-shrink-0 shadow cursor-default select-none">
    <div class="flex-1 flex flex-col justify-between py-4 text-black dark:text-white">
        <x-interface.main-menu></x-interface.main-menu>

        <div class="inline-block px-6 mt-4 text-grey-60 dark:text-grey-20">
            <h5>© Hampshire Scouts {{ date('Y') }}</h5>
            <a class="font-bold hover:underline" href="#">Privacy Policy</a>
        </div>
    </div>
</aside>

<!-- Mobile sidebar -->
<aside
    class="flex fixed inset-y-0 z-20 flex-shrink-0 mt-16 overflow-y-auto bg-gray-50 dark:bg-gray-800 md:hidden min-w-80 max-w-9/10"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="isSideMenuOpen = false"
    @keydown.escape="isSideMenuOpen = false">
    <div class="flex flex-1 flex-col justify-between py-4 text-black dark:text-white">

        <x-interface.main-menu></x-interface.main-menu>

    </div>
</aside>

<!-- Mobile accounts sidebar -->
<aside
    class="flex fixed inset-y-0 z-20 flex-shrink-0 mt-16 overflow-y-auto bg-gray-50 dark:bg-gray-800 md:hidden min-w-80 max-w-9/10"
    x-show="isUserMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="isUserMenuOpen = false"
    @keydown.escape="isUserMenuOpen = false">
    <div class="flex flex-1 flex-col justify-between pb-4 text-black dark:text-white">

        <div class="pt-2 px-4">
            <x-interface.accounts-menu paddingX="2"></x-interface.accounts-menu>
        </div>

        <div class="inline-block px-6  mt-4 text-grey-60 dark:text-grey-20">
            <h5>© Hampshire Scouts {{ date('Y') }}</h5>
            <a class="font-bold hover:underline" href="#">Privacy Policy</a>
        </div>

    </div>
</aside>

<!-- Backdrop -->
<div x-show="isSideMenuOpen || isUserMenuOpen" x-transition:enter="transition ease-in-out duration-150"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

