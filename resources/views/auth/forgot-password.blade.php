<x-guest-layout>
    <x-slot name="title">Forgot Password</x-slot>
    <x-authentication.card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-100">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-utilities.label for="email" value="Email"></x-utilities.label>
                <x-utilities.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                   required autofocus></x-utilities.input>
            </div>

            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>

            <div class="flex items-center justify-end mt-8">
                <x-utilities.button>Email Password Reset Link</x-utilities.button>
            </div>
        </form>
    </x-authentication.card>
</x-guest-layout>
