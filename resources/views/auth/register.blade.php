<x-guest-layout>
    <x-slot name="title">Register</x-slot>
    <x-authentication.card>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-utilities.label for="name" value="Name"></x-utilities.label>
                <x-utilities.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                   required autofocus autocomplete="name"></x-utilities.input>
            </div>

            <div class="mt-4">
                <x-utilities.label for="email" value="Email"></x-utilities.label>
                <x-utilities.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                   required></x-utilities.input>
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

            <div class="mt-4">
                <x-utilities.label for="district" value="District"></x-utilities.label>
                <x-utilities.select id="district" name="district">
                    <option value="null">Select...</option>
                    @foreach(\App\Models\District::orderBy('name')->get() as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </x-utilities.select>
            </div>


            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>

            <div class="flex items-center justify-end mt-8">
                <x-utilities.secondary-link href="{{ route('login') }}">Already registered?</x-utilities.secondary-link>
                <x-utilities.button class="ml-4">Register</x-utilities.button>
            </div>
        </form>
    </x-authentication.card>
</x-guest-layout>
