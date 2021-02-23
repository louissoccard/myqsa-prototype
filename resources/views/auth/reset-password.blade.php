<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>
    <x-authentication.card>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-utilities.label for="email" value="Email"></x-utilities.label>
                <x-utilities.input id="email" class="block mt-1 w-full" type="email" name="email"
                                   :value="old('email', $request->email)" required autofocus></x-utilities.input>
            </div>

            <div class="mt-4">
                <x-utilities.label for="password" value="Password"></x-utilities.label>
                <x-utilities.input id="password" class="block mt-1 w-full" type="password" name="password" required
                                   autocomplete="new-password"></x-utilities.input>
            </div>

            <div class="mt-4">
                <x-utilities.label for="password_confirmation" value="Confirm Password"></x-utilities.label>
                <x-utilities.input id="password_confirmation" class="block mt-1 w-full" type="password"
                                   name="password_confirmation" required
                                   autocomplete="new-password"></x-utilities.input>
            </div>

            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>

            <div class="flex items-center justify-end mt-8">
                <x-utilities.button>Reset Password</x-utilities.button>
            </div>
        </form>
    </x-authentication.card>
</x-guest-layout>
