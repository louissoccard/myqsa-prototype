<x-guest-layout>
    <x-authentication-card>
        <div class="w-full flex flex-col mt-5 mb-10">
            @auth
                <x-link-button class="flex justify-center" href="{{ route('dashboard') }}">Dashboard</x-link-button>
            @else
                <x-link-button class="mb-4 flex justify-center" href="{{ route('login') }}">Login</x-link-button>
                <x-link-button class="flex justify-center" href="{{ route('register') }}">Register</x-link-button>
            @endauth
        </div>
    </x-authentication-card>
</x-guest-layout>
