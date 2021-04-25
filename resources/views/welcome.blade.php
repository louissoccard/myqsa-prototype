<x-guest-layout>
    <x-authentication.card>
        <div class="w-full flex flex-col mt-5 mb-10">
            @auth
                <x-utilities.link-button class="flex justify-center" href="{{ route('dashboard') }}">Dashboard
                </x-utilities.link-button>
            @else
                <x-utilities.link-button class="mb-4 flex justify-center" href="{{ route('sign-in') }}">Login
                </x-utilities.link-button>
                <x-utilities.link-button class="flex justify-center" href="{{ route('register') }}">Register
                </x-utilities.link-button>
            @endauth
        </div>
    </x-authentication.card>
</x-guest-layout>
