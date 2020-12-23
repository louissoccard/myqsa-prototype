<x-guest-layout>
    <x-slot name="title">Login</x-slot>
    <x-authentication-card>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}"></x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus></x-input>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"></x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"></x-input>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-200">{{ __('Remember me') }}</span>
                </label>
            </div>

            <x-validation-errors class="mt-4"></x-validation-errors>

            <div class="flex items-center justify-end mt-8">
                @if (Route::has('password.request'))
                    <x-secondary-link href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</x-secondary-link>
                @endif

                <x-button class="ml-4">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
