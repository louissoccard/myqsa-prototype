<x-app-layout>
    <x-slot name="title">Manage Account</x-slot>
    <h2 class="text-2xl font-black mb-4">Manage Account</h2>

    <div class="flex flex-wrap items-stretch">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="flex w-full xl:w-1/2 mb-4 xl:pr-2">
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="flex w-full xl:w-1/2 mb-4 xl:pl-2">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="flex w-full xl:w-1/2 mb-4 xl:pr-2">
                @livewire('profile.update-appearance-preferences-form')
            </div>
        @endif

        <div class="flex w-full xl:w-1/2 mb-4 xl:pl-2">
            @livewire('profile.delete-user-form')
        </div>
    </div>

    <h3 class="text-xl font-bold my-4">Advanced Settings</h3>

    <div class="flex flex-wrap items-stretch">
        <div class="flex w-full xl:w-1/2 mb-4 xl:mb-0 xl:pr-2">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="flex w-full xl:w-1/2 xl:pl-2">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif
    </div>
</x-app-layout>
