@if($view_modal_current_user !== null)
    <x-utilities.dialog-modal wire:model="add_role_modal_visible" zIndex="110">
        <x-slot name="title">Add Role</x-slot>
        <x-slot name="content">
            <p class="mb-2">Add a role to
                {{ Str::namePlural($view_modal_current_user->first_name) }} account.</p>

            <x-utilities.select wire:model="new_role">
                <option value="none">Please select...</option>
                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                    @if(!$view_modal_current_user->hasRole($role))
                        <option value="{{ $role["name"] }}">{{ $role["title"] }}</option>
                    @endif
                @endforeach
            </x-utilities.select>

            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeAddRoleModal">Cancel
            </x-utilities.button>
            <x-utilities.button type="submit" colour="navy" wire:click="addRole" icon="plus">Add</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>

    @if($remove_role !== null)
        <x-utilities.dialog-modal wire:model="remove_role_modal_visible" zIndex="110">
            <x-slot name="title">Remove Role</x-slot>
            <x-slot name="content">
                <p>Are you sure you want to remove the {{ $remove_role["title"] }} role from
                    {{ Str::namePlural($view_modal_current_user->first_name) }} account?</p>

                <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>
            </x-slot>
            <x-slot name="footer">
                <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeRemoveRoleModal">Cancel
                </x-utilities.button>
                <x-utilities.button colour="red" wire:click="removeRole" icon="trash-2">Remove</x-utilities.button>
            </x-slot>
        </x-utilities.dialog-modal>
    @endif

    <x-utilities.dialog-modal wire:model="add_permission_modal_visible" zIndex="110">
        <x-slot name="title">Add Permission</x-slot>
        <x-slot name="content">
            <p class="mb-2">Add a permission to
                {{ Str::namePlural($view_modal_current_user->first_name) }} account.</p>

            <x-utilities.select wire:model="new_permission">
                <option value="none">Please select...</option>
                @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                    @if(!$view_modal_current_user->hasPermissionTo($permission))
                        <option value="{{ $permission["name"] }}">{{ $permission["title"] }}</option>
                    @endif
                @endforeach
            </x-utilities.select>

            <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeAddPermissionModal">Cancel
            </x-utilities.button>
            <x-utilities.button colour="navy" wire:click="addPermission" icon="plus">Add</x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>

    @if($remove_permission !== null)
        <x-utilities.dialog-modal wire:model="remove_permission_modal_visible" zIndex="110">
            <x-slot name="title">Remove Permission</x-slot>
            <x-slot name="content">
                <p>Are you sure you want to remove the {{ $remove_permission["title"] }} permission from
                    {{ Str::namePlural($view_modal_current_user->first_name) }} account?</p>

                <x-utilities.validation-errors class="mt-4"></x-utilities.validation-errors>
            </x-slot>
            <x-slot name="footer">
                <x-utilities.button colour="grey-40" class="mr-2" wire:click="closeRemovePermissionModal">Cancel
                </x-utilities.button>
                <x-utilities.button colour="red" wire:click="removePermission" icon="trash-2">Remove
                </x-utilities.button>
            </x-slot>
        </x-utilities.dialog-modal>
    @endif

    <x-utilities.dialog-modal wire:model="permissions_modal_visible" zIndex="100">
        <x-slot name="title">{{ Str::namePlural($view_modal_current_user->first_name) }} Roles and Permissions</x-slot>
        <x-slot name="content">
            <div class="flex flex-row">
                <div class="w-1/2 pr-2">
                    <div class="flex justify-between">
                        <h6>Roles</h6>
                        @if ($roles != null && \Spatie\Permission\Models\Role::all()->count() > count($roles))
                            <div class="cursor-pointer" wire:click="showAddRoleModal">
                                <x-utilities.icon size="16">plus</x-utilities.icon>
                            </div>
                        @endif
                    </div>
                    <div class="border-t border-grey-20 dark:border-grey-60">
                        @if ($roles != null)
                            @foreach ($roles as $role)
                                <div
                                    class="flex items-center justify-between p-2 border-b border-grey-20 dark:border-grey-60">
                                    <span>{{ $role['title'] }}</span>
                                    @if(count($roles) > 1)
                                        <div class="cursor-pointer" wire:click="requestRoleRemoval({{ $role['id'] }})">
                                            <x-utilities.icon size="16">trash-2</x-utilities.icon>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-1/2 pl-2">
                    <div class="flex justify-between">
                        <h6>Permissions</h6>
                        @if ($permissions != null && \Spatie\Permission\Models\Permission::all()->count() > count($permissions))
                            <div class="cursor-pointer" wire:click="showAddPermissionModal">
                                <x-utilities.icon size="16">plus</x-utilities.icon>
                            </div>
                        @endif
                    </div>
                    <div class="border-t border-grey-20 dark:border-grey-60">
                        @if ($permissions != null)
                            @foreach ($permissions as $permission)
                                <div
                                    class="flex items-center justify-between p-2 border-b border-grey-20 dark:border-grey-60">
                                    <div>
                                        <span>{{ $permission["title"] }}</span>
                                        <span class="text-xs">{{ $permission["name"] }}</span>
                                    </div>
                                    @if($view_modal_current_user->hasDirectPermission($permission['name']))
                                        <div class="cursor-pointer"
                                             wire:click="requestPermissionRemoval({{ $permission['id'] }})">
                                            <x-utilities.icon size="16">trash-2</x-utilities.icon>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-utilities.button colour="grey-60" class="mr-2" wire:click="closePermissionsModal">Close
            </x-utilities.button>
        </x-slot>
    </x-utilities.dialog-modal>
@endif
