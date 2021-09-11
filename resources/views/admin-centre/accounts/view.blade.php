@if($view_modal_current_user !== null)
    <x-utilities.dialog-modal wire:model="new_password_modal_visible" backgroundDismissible="false" zIndex="40">
        <x-slot name="title">{{ \App\Facades\Str::namePlural($view_modal_current_user->first_name) }} New Password
        </x-slot>
        <x-slot name="content">
            <p class="mb-2">Please copy {{ \App\Facades\Str::namePlural($view_modal_current_user->full_name) }} new
                            password. This is the only time
                            you will be
                            able to view it.</p>
            <p class="w-min p-2 font-mono text-sm bg-gray-100 dark:bg-black">{{ $new_password }}</p>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button wire:click="closeNewPasswordModal">Okay</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>

    <x-utilities.dialog-modal wire:model="password_modal_visible" zIndex="40">
        <x-slot name="title">Reset {{ \App\Facades\Str::namePlural($view_modal_current_user->first_name) }} Password
        </x-slot>
        <x-slot name="content">
            <p>Are you sure you would like to
               reset {{ \App\Facades\Str::namePlural($view_modal_current_user->full_name) }} password?
               They will be signed out of all devices and required to use the new password.</p>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button wire:click="closeDeleteModal" colour="grey-60">Cancel</x-utilities.button>
            <x-utilities.button wire:click="resetPassword" class="ml-2" colour="red">Reset Password</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>

    <x-utilities.dialog-modal wire:model="delete_modal_visible" zIndex="40">
        <x-slot name="title">Delete {{ \App\Facades\Str::namePlural($view_modal_current_user->first_name) }} Account
        </x-slot>
        <x-slot name="content">
            <p>Are you sure you would like to
               delete {{ \App\Facades\Str::namePlural($view_modal_current_user->full_name) }} account?
               Once their account is deleted, it cannot be reinstated. All their data will be deleted.</p>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button wire:click="closeDeleteModal" colour="grey-60">Cancel</x-utilities.button>
            <x-utilities.button wire:click="deleteUser" class="ml-2" colour="red">Delete Account</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>

    <x-utilities.dialog-modal wire:model="view_modal_visible" max-width="5xl">
        <x-slot name="content">
            <div class="px-6 py-4">
                <div class="pb-4 mb-4 border-b border-gray-300 dark:border-gray-700">
                    <h3 class="font-black text-2xl">{{ $view_modal_current_user->full_name }}</h3>
                    <h5 class="text-xl">{{ $view_modal_current_user->district->name }}</h5>
                </div>

                <div class="flex flex-wrap flex-col md:flex-row">
                    <div class="w-full md:w-2/3 md:pr-2 mb-4 md:mb-0">
                        <h5 class="text-lg font-bold">Details</h5>
                        <div class="mb-2">
                            <p class="text-sm">Email</p>
                            <p>{{ $view_modal_current_user->email }}</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-sm">Account created on</p>
                            <p>{{ $view_modal_current_user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 md:pl-2">
                        <h5 class="text-lg font-bold">Actions</h5>
                        <div class="mb-4">
                            <x-utilities.dropdown-item icon="map" iconPos="end" paddingX="2"
                                                       wire:click="showDistrictsModal">
                                Change District Access
                            </x-utilities.dropdown-item>
                            @if($this->view_modal_current_user->isNot(Auth::user()))
                                <x-utilities.dropdown-item icon="edit-2" iconPos="end" paddingX="2"
                                                           wire:click="showEditModal">
                                    Edit Details
                                </x-utilities.dropdown-item>
                                <x-authentication.confirms-password wire:then="showPasswordModal">
                                    <x-utilities.dropdown-item icon="lock" iconPos="end" paddingX="2">Reset Password
                                    </x-utilities.dropdown-item>
                                </x-authentication.confirms-password>
                                <x-authentication.confirms-password wire:then="showDeleteModal">
                                    <x-utilities.dropdown-item icon="trash-2" iconPos="end" paddingX="2"
                                                               class="text-red">
                                        Delete Account
                                    </x-utilities.dropdown-item>
                                </x-authentication.confirms-password>
                            @else
                                <p class="px-2">You cannot change your own account from here. Please
                                                go to the
                                    <x-utilities.link href="{{ route('account.manage.show') }}">Manage Account
                                    </x-utilities.link>
                                                page.
                                </p>
                            @endif
                        </div>
                        <h6 class="font-bold">Advanced</h6>
                        <x-utilities.dropdown-item icon="key" iconPos="end" paddingX="2"
                                                   wire:click="showPermissionsModal">
                            Roles and Permissions
                        </x-utilities.dropdown-item>
                    </div>
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            @if($view_modal_current_user->hasPermissionTo('qsa.has'))
                <x-utilities.button class="mr-2" wire:click="viewUserAward" icon="award">Award</x-utilities.button>
            @endif
            <x-utilities.button colour="grey-60" wire:click="closeViewModal">Close</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
@endif
