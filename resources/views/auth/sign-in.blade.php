<x-guest-layout>
    <x-slot name="title">Sign In</x-slot>
    <x-authentication.card>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('sign-in') }}">
            @csrf

            <div>
                <x-utilities.label for="email" value="Email"></x-utilities.label>
                <x-utilities.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                   required autofocus autocomplete="email" autocapitalize="off"></x-utilities.input>
            </div>

            <div class="mt-4">
                <x-utilities.label for="password" value="Password"></x-utilities.label>
                <x-utilities.input id="password" class="block mt-1 w-full" type="password" name="password" required
                                   autocomplete="current-password"></x-utilities.input>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-200">Remember me</span>
                </label>
            </div>

            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>

            <div class="flex items-center justify-end mt-8">
                @if (Route::has('password.request'))
                    <x-utilities.secondary-link href="{{ route('password.request') }}">Forgot your password?
                    </x-utilities.secondary-link>
                @endif

                <x-utilities.button class="ml-4">Sign In</x-utilities.button>
            </div>
        </form>
    </x-authentication.card>
</x-guest-layout>
