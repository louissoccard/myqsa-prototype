<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>
    <x-authentication-card>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}"></x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus></x-input>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"></x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password"></x-input>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"></x-label>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password"></x-input>
            </div>

            <x-validation-errors class="mt-4"></x-validation-errors>

            <div class="flex items-center justify-end mt-8">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
