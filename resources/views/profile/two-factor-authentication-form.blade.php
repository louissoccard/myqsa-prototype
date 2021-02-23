<x-interface.card title="Two Factor Authentication"
                  description="Add additional security to your account using two factor authentication."
                  help="When two factor authentication is enabled, you will be prompted for a secure, random
                        token during authentication. You may retrieve this token from your phone's authenticator app.
                        We recommend trying the <a href='https://www.microsoft.com/en-gb/account/authenticator' class='text-blue font-bold hover:underline' target='_blank'>Microsoft Authenticator</a> app.">

    <div class="flex flex-1 flex-col justify-between">

        <div class="flex flex-col items-center text-center">
            <div class="my-4">
                @if ($this->enabled)
                    <x-utilities.icon size="36" class="inline text-green mb-2">check-circle</x-utilities.icon>
                    <h3 class="font-bold">
                        You have two factor authentication enabled.
                    </h3>
                @else
                    <x-utilities.icon size="36" class="inline text-red mb-2">alert-circle</x-utilities.icon>
                    <h3 class="font-bold">
                        You do not have two factor authentication enabled.
                    </h3>
                @endif
            </div>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm">
                        <p class="font-semibold">Two factor authentication is now enabled. Scan the following QR code
                                                 using your phone's authenticator application.</p>
                    </div>

                    <div class="mt-4 p-4 dark:bg-white w-min">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm">
                        <p class="font-semibold">Store these recovery codes in a secure password manager. They can be
                                                 used to recover access to your account if your two factor
                                                 authentication device is lost.</p>
                    </div>

                    <div
                        class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-black rounded-none">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>

        <div class="flex justify-end w-full mt-4">
            @if (! $this->enabled)
                <x-authentication.confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-utilities.button type="button" wire:loading.attr="disabled">Enable</x-utilities.button>
                </x-authentication.confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-authentication.confirms-password wire:then="regenerateRecoveryCodes">
                        <x-utilities.button class="mr-3" colour="grey-60">Regenerate Recovery Codes</x-utilities.button>
                    </x-authentication.confirms-password>
                @else
                    <x-authentication.confirms-password wire:then="showRecoveryCodes">
                        <x-utilities.button class="mr-3" colour="grey-60">Show Recovery Codes</x-utilities.button>
                    </x-authentication.confirms-password>
                @endif

                <x-authentication.confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-utilities.button wire:loading.attr="disabled" colour="red">Disable</x-utilities.button>
                </x-authentication.confirms-password>
            @endif
        </div>

    </div>
</x-interface.card>
