<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ isSideMenuOpen: false, isUserMenuOpen: false, isUserDropdownOpen: false }" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' : '' }}myQSA</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,700;0,800;0,900;1,400&display=swap"
            rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/scripts.js') }}"></script>
        <x-utilities.dark-mode></x-utilities.dark-mode>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="flex flex-col h-full font-sans antialiased dark:bg-gray-900 text-grey-80 dark:text-grey-5"
          :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-interface.header></x-interface.header>
        <div class="flex flex-1">
            <x-interface.sidebar></x-interface.sidebar>

            <div class="flex flex-col flex-1 w-full">
                @isset($pageHeader) {{ $pageHeader }} @endisset
                <main class="overflow-y-auto">
                    <div class="container mx-auto p-6 md:p-10 grid">

                        {{ $slot }}

                    </div>
                </main>
            </div>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
