<x-guest-layout>
    <x-slot name="title">Register</x-slot>
    <x-authentication.card>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex justify-between">
                <div class="w-1/2 pr-2">
                    <x-utilities.label for="first_name" value="First Name"></x-utilities.label>
                    <x-utilities.input id="first_name" class="block mt-1" type="text" name="first_name"
                                       :value="old('first_name')"
                                       required autofocus autocomplete="given-name"></x-utilities.input>
                </div>
                <div class="w-1/2 pl-2">
                    <x-utilities.label for="last_name" value="Last Name"></x-utilities.label>
                    <x-utilities.input id="last_name" class="block mt-1" type="text" name="last_name"
                                       :value="old('last_name')"
                                       required autocomplete="family-name"></x-utilities.input>
                </div>
            </div>

            <div class="mt-4">
                <x-utilities.label for="email" value="Email"></x-utilities.label>
                <x-utilities.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                   required autocomplete="email"></x-utilities.input>
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
                <x-utilities.secondary-link href="{{ route('sign-in') }}">Already registered?
                </x-utilities.secondary-link>
                <x-utilities.button class="ml-4">Register</x-utilities.button>
            </div>
        </form>
    </x-authentication.card>
</x-guest-layout>
