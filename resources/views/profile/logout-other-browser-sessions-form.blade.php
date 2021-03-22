<x-interface.card title="Browser Sessions"
                  description="Manage and sign out your active sessions on other browsers and devices."
                  help='If necessary, you may sign out of all of your other browser sessions across
               all of your devices. Some of your recent sessions are listed below; however,
               this list may not be exhaustive. If you feel your account has been
               compromised, you should also <a class="text-blue font-bold cursor-pointer hover:underline"
               onclick="scrollToPassword()">update your password</a>.'>

    <div class="flex flex-1 flex-col justify-between">

        <script>
            function scrollToPassword() {
                let updatePassword = document.getElementById('update-password');
                if (updatePassword !== null) updatePassword.scrollIntoView({behavior: 'smooth', block: 'center'});
            }
        </script>

        <div>
            @if (count($this->sessions) > 0)
                <div class="px-6">
                    <div class="border-t border-grey-20 dark:border-grey-60">
                        <!-- Other Browser Sessions -->
                        @foreach ($this->sessions as $session)
                            <div
                                class="flex items-center justify-between p-2 border-b border-grey-20 dark:border-grey-60">
                                <div class="mr-3">
                                    <div>
                                        @if($session->agent->platform() === 'OS X')
                                            macOS - {{ $session->agent->browser() }}
                                        @else
                                            {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                                        @endif

                                    </div>

                                    <div>
                                        <div class="text-xs">
                                            {{ $session->ip_address }}
                                            @if ($session->is_current_device)
                                                <span class="text-green font-bold">(this device)</span>
                                            @else
                                                (Last active {{ $session->last_active }})
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    @if ($session->agent->isDesktop())
                                        <x-utilities.icon>monitor</x-utilities.icon>
                                    @else
                                        <x-utilities.icon>smartphone</x-utilities.icon>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex justify-end w-full mt-4">
            <x-utilities.action-message class="mr-3" on="loggedOut">Done.</x-utilities.action-message>
            <x-utilities.button wire:click="confirmLogout" wire:loading.attr="disabled">Sign Out Other Browser
                                                                                        Sessions
            </x-utilities.button>
        </div>
    </div>

    {{-- Logout Other Devices Confirmation Modal --}}
    <x-utilities.dialog-modal wire:model="confirmingLogout">
        <x-slot name="title">Sign Out Other Browser Sessions</x-slot>

        <x-slot name="content">Please enter your password to confirm you would like to sign out of your other browser
                               sessions across all of your devices.
            <div class="mt-4" x-data="{}"
                 x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-utilities.input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                   x-ref="password"
                                   wire:model.defer="password"
                                   wire:keydown.enter="logoutOtherBrowserSessions"></x-utilities.input>

                <x-utilities.input-error for="password" class="mt-2"></x-utilities.input-error>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-col sm:flex-row justify-end">
                <x-utilities.button class="mb-2 sm:mb-0" wire:click="$toggle('confirmingLogout')"
                                    wire:loading.attr="disabled" colour="grey-60">Nevermind
                </x-utilities.button>

                <x-utilities.button class="sm:ml-2" wire:click="logoutOtherBrowserSessions"
                                    wire:loading.attr="disabled">Sign Out Other Browser Sessions
                </x-utilities.button>
            </div>
        </x-slot>
    </x-utilities.dialog-modal>
</x-interface.card>
