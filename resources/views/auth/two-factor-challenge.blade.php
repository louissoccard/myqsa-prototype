<x-guest-layout>
    <x-slot name="title">Two Factor Challenge</x-slot>
    <x-authentication.card>
        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-200" x-show="! recovery">Please confirm access to your
                                                                                           account by entering the
                                                                                           authentication code provided
                                                                                           by your authenticator
                                                                                           application.
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-200" x-show="recovery">Please confirm access to your
                                                                                         account by entering one of your
                                                                                         emergency recovery codes.
            </div>

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-utilities.label for="code" value="Code"></x-utilities.label>
                    <x-utilities.input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code"
                                       autofocus x-ref="code" autocomplete="one-time-code"></x-utilities.input>
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-utilities.label for="recovery_code" value="Recovery Code"></x-utilities.label>
                    <x-utilities.input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                                       x-ref="recovery_code" autocomplete="one-time-code"></x-utilities.input>
                </div>

                <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>

                <div class="flex items-center justify-end mt-8">
                    <x-utilities.button type="button" x-show="! recovery" x-on:click="recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })">Use a recovery code
                    </x-utilities.button>

                    <x-utilities.button type="button" x-show="recovery" x-on:click="recovery = false;
                                        $nextTick(() => { $refs.code.focus() })">Use an authentication code
                    </x-utilities.button>

                    <x-utilities.button class="ml-4">Sign In</x-utilities.button>
                </div>
            </form>
        </div>
    </x-authentication.card>
</x-guest-layout>
