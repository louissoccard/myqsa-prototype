<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Actions\Fortify\UserValidationRules;
use App\Http\Livewire\NumberedTableComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Kdion4891\LaravelLivewireTables\Column;
use Laravel\Jetstream\ConfirmsPasswords;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class Table provides the accounts table in the admin centre as a livewire component
 *
 * @package App\Http\Livewire\Admin\Accounts
 */
class Table extends NumberedTableComponent
{
    use ConfirmsPasswords;
    use UserValidationRules;

    // Set the default sort direction, this is used to calculate the number for each row
    public $sort_direction = 'asc';
    public $original_sort_direction = 'asc';

    // Set the default row to be sorted, again used to calculate the number for each row
    public $sort_attribute = 'full_name';
    public $original_sort_attribute = 'full_name';

    // Add the buttons and modals that appear in the section before the table
    public $header_view = 'components.admin-centre.accounts.table-header';

    public $per_page = 30;

    // Create user
    public $add_modal_visible = false;
    public $add_modal_first_name = null;
    public $add_modal_last_name = null;
    public $add_modal_email = null;
    public $add_modal_password = null;
    public $add_modal_password_confirmation = null;
    public $add_modal_district_id = null;

    protected $validationAttributes = [
        'add_modal_first_name'   => 'first name',
        'add_modal_last_name'    => 'last name',
        'add_modal_email'        => 'email',
        'add_modal_district_id'  => 'district',
        'add_modal_password'     => 'password',
        'edit_modal_first_name'  => 'first name',
        'edit_modal_last_name'   => 'last name',
        'edit_modal_email'       => 'email',
        'edit_modal_district_id' => 'district',
    ];

    // View user
    public $view_modal_visible = false;
    public $view_modal_current_user = null;
    public $new_password = null;
    public $password_modal_visible = false;
    public $new_password_modal_visible = false;

    // Delete user
    public $delete_modal_visible = false;

    // Edit user
    public $edit_modal_visible = false;
    public $edit_modal_original_name = '';
    public $edit_modal_first_name = null;
    public $edit_modal_last_name = null;
    public $edit_modal_email = null;
    public $edit_modal_district_id = null;

    // Districts
    public $districts_modal_visible = false;
    public $districts_modal_current = 'none';
    public $districts_modal_current_can_view = false;
    public $districts_modal_current_can_edit = false;


    // Permissions
    public $permissions_modal_visible = false;
    public $roles = null;
    public $permissions = null;

    public $add_role_modal_visible = false;
    public $new_role = 'none';
    public $remove_role_modal_visible = false;
    public $remove_role = null;

    public $add_permission_modal_visible = false;
    public $new_permission = 'none';
    public $remove_permission_modal_visible = false;
    public $remove_permission = null;

    // Adjust the size and positioning of the manage column
    public function thClass($attribute)
    {
        if ($attribute == 'manage') {
            return 'w-12 text-center';
        }

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'manage') {
            return 'w-12 text-right';
        }

        return null;
    }

    public function query()
    {
        return User::with('district');
    }

    public function columns()
    {
        return [
            Column::make('Name', 'full_name')->sortable()->searchable(),
            Column::make('District', 'district.name')->sortable()->searchable(),
            Column::make('Manage')->view('admin-centre.accounts.menu'),
        ];
    }

    public function models()
    {
        $models = parent::models();
        $models->select('users.*');

        return $models;
    }

    // Add User
    public function showAddModal()
    {
        $this->resetErrorBag();
        $this->add_modal_password = Str::random(12); // Generate a new random password each time
        $this->add_modal_visible  = true;

        $this->emit('add-modal-shown');
    }

    public function closeAddModal()
    {
        $this->add_modal_visible     = false;
        $this->add_modal_first_name  = '';
        $this->add_modal_last_name   = '';
        $this->add_modal_email       = '';
        $this->add_modal_password    = '';
        $this->add_modal_district_id = '';
    }

    public function addUser()
    {
        $this->add_modal_password_confirmation = $this->add_modal_password;

        $this->validate([
            'add_modal_first_name'  => $this->userRules()['first_name'],
            'add_modal_last_name'   => $this->userRules()['last_name'],
            'add_modal_email'       => $this->userRules()['email'],
            'add_modal_password'    => $this->userRules()['password'],
            'add_modal_district_id' => $this->userRules()['district'],
        ]);

        User::create([
            'first_name'  => $this->add_modal_first_name,
            'last_name'   => $this->add_modal_last_name,
            'email'       => $this->add_modal_email,
            'password'    => Hash::make($this->add_modal_password),
            'district_id' => $this->add_modal_district_id,
        ]);

        $this->closeAddModal();
    }

    // Edit user
    public function showViewModal(int $userId)
    {
        $this->resetErrorBag();
        $this->view_modal_current_user = User::find($userId);

        if ($this->view_modal_current_user !== null) {
            $this->view_modal_visible = true;
            session()->forget('auth.password_confirmed_at');

            $this->emit('edit-modal-shown');
        }
    }

    public function closeViewModal()
    {
        $this->view_modal_visible      = false;
        $this->new_password            = null;
        $this->view_modal_current_user = null;
    }

    // Open user's award page
    public function viewUserAward($id = null)
    {
        if ($id !== null) {
            Session::put('award_user', $id);
        } elseif ($this->view_modal_current_user !== null) {
            Session::put('award_user', $this->view_modal_current_user->id);
        } else {
            return;
        }

        Session::put('award_redirect_route', 'admin-centre.accounts');
        $this->redirect('/award');
    }

    // Reset user password
    public function showPasswordModal()
    {
        $this->ensurePasswordIsConfirmed(5);
        session()->forget('auth.password_confirmed_at');

        $this->password_modal_visible = true;
    }

    public function closePasswordModal()
    {
        $this->password_modal_visible = false;
    }

    public function resetPassword()
    {
        if ($this->view_modal_current_user !== null && $this->view_modal_current_user->isNot(Auth::user())) {
            $this->password_modal_visible = false;

            $this->new_password = Str::random(12);

            $this->view_modal_current_user->forceFill([
                'password' => Hash::make($this->new_password),
            ])->save();

            session()->forget('auth.password_confirmed_at');

            $this->new_password_modal_visible = true;
        }
    }

    public function closeNewPasswordModal()
    {
        $this->new_password_modal_visible = false;
        $this->new_password               = null;
    }

    // Delete user
    public function showDeleteModal()
    {
        $this->ensurePasswordIsConfirmed(5);
        session()->forget('auth.password_confirmed_at');

        $this->delete_modal_visible = true;
    }

    public function closeDeleteModal()
    {
        $this->delete_modal_visible = false;
    }

    public function deleteUser()
    {
        if ($this->view_modal_current_user !== null && $this->view_modal_current_user->isNot(Auth::user())) {

            $this->view_modal_current_user->delete();

            $this->closeDeleteModal();
            $this->closeViewModal();
        }
    }

    // Edit user
    public function showEditModal()
    {
        if ($this->view_modal_current_user !== null) {
            $this->edit_modal_original_name = $this->view_modal_current_user->first_name;

            $this->edit_modal_first_name  = $this->view_modal_current_user->first_name;
            $this->edit_modal_last_name   = $this->view_modal_current_user->last_name;
            $this->edit_modal_email       = $this->view_modal_current_user->email;
            $this->edit_modal_district_id = $this->view_modal_current_user->district_id;


            $this->edit_modal_visible = true;
        }
    }

    public function saveEditUser()
    {
        if ($this->view_modal_current_user !== null) {
            $this->validate([
                'edit_modal_first_name'  => $this->userRules()['first_name'],
                'edit_modal_last_name'   => $this->userRules()['last_name'],
                'edit_modal_email'       => $this->userRules($this->view_modal_current_user->id)['email'],
                'edit_modal_district_id' => $this->userRules()['district'],
            ]);

            $this->view_modal_current_user->first_name  = $this->edit_modal_first_name;
            $this->view_modal_current_user->last_name   = $this->edit_modal_last_name;
            $this->view_modal_current_user->email       = $this->edit_modal_email;
            $this->view_modal_current_user->district_id = $this->edit_modal_district_id;
            $this->view_modal_current_user->save();

            // Update the stored user with the latest data so their district changes
            $this->view_modal_current_user = User::find($this->view_modal_current_user->id);

            $this->closeEditModal();
        }
    }

    public function closeEditModal()
    {
        $this->edit_modal_visible = false;
    }

    // Districts Access
    public function showDistrictsModal()
    {
        $this->districts_modal_visible = true;
    }

    public function closeDistrictsModal()
    {
        $this->districts_modal_visible = false;
    }

    public function districtUpdated()
    {
        if ($this->view_modal_current_user !== null && $this->districts_modal_current !== 'none') {
            $this->districts_modal_current_can_view = $this->view_modal_current_user->hasPermissionTo("qsa.district.view.{$this->districts_modal_current}");
            $this->districts_modal_current_can_edit = $this->view_modal_current_user->hasPermissionTo("qsa.district.edit.{$this->districts_modal_current}");
        }
    }

    public function grantDistrictView(int $id)
    {
        if ( ! $this->view_modal_current_user == null && ! $this->districts_modal_current == null && Permission::where('name',
                "qsa.district.view.$id")->exists()) {
            $this->view_modal_current_user->givePermissionTo("qsa.district.view.$id");
            $this->districtUpdated();
        }
    }

    public function revokeDistrictView(int $id)
    {
        if ( ! $this->view_modal_current_user == null && ! $this->districts_modal_current == null && Permission::where('name',
                "qsa.district.view.$id")->exists()) {
            $this->view_modal_current_user->revokePermissionTo("qsa.district.view.$id");
            $this->districtUpdated();
        }
    }

    public function grantDistrictEdit(int $id)
    {
        if ( ! $this->view_modal_current_user == null && ! $this->districts_modal_current == null && Permission::where('name',
                "qsa.district.edit.$id")->exists()) {
            $this->view_modal_current_user->givePermissionTo("qsa.district.edit.$id");
            $this->districtUpdated();
        }
    }

    public function revokeDistrictEdit(int $id)
    {
        if ( ! $this->view_modal_current_user == null && ! $this->districts_modal_current == null && Permission::where('name',
                "qsa.district.edit.$id")->exists()) {
            $this->view_modal_current_user->revokePermissionTo("qsa.district.edit.$id");
            $this->districtUpdated();
        }
    }


    // Roles and Permissions
    public function updateListOfRolesAndPermissions()
    {
        $this->roles       = $this->view_modal_current_user->getAllRoles()->all();
        $this->permissions = $this->view_modal_current_user->getAllPermissions()->all();
    }

    public function showPermissionsModal()
    {
        if ($this->view_modal_current_user !== null) {
            $this->updateListOfRolesAndPermissions();
            $this->permissions_modal_visible = true;
        }
    }

    public function closePermissionsModal()
    {
        $this->permissions_modal_visible = false;
    }

    public function showAddRoleModal()
    {
        $this->add_role_modal_visible = true;
    }

    public function addRole()
    {
        if ($this->new_role !== null && $this->view_modal_current_user !== null) {
            if ($this->view_modal_current_user->hasRole($this->new_role)) {
                $this->addError("Cannot add role", "The user already has this role");
            } elseif ($this->new_role === 'none') {
                $this->addError("Cannot add role", "You must select a role");
            } elseif ( ! Role::where('name', $this->new_role)->exists()) {
                $this->addError("Cannot add role", "This role does not exists");
            } else {
                $this->view_modal_current_user->assignRole($this->new_role);
                $this->new_role = 'none';
                $this->updateListOfRolesAndPermissions();
                $this->closeAddRoleModal();
            }

            return;
        }

        $this->addError("Cannot add role", "Failed to add the selected role");
    }

    public function closeAddRoleModal()
    {
        $this->add_role_modal_visible = false;
    }

    public function showRemoveRoleModal()
    {
        $this->remove_role_modal_visible = true;
    }

    public function requestRoleRemoval(Role $role)
    {
        $this->remove_role = $role;

        $this->showRemoveRoleModal();
    }

    public function removeRole()
    {
        if ($this->remove_role !== null && $this->view_modal_current_user !== null) {
            if ( ! $this->view_modal_current_user->hasRole($this->remove_role)) {
                $this->addError("Cannot remove role", "The user does not have this role");
            } elseif ( ! Role::where('name', $this->remove_role['name'])->exists()) {
                $this->addError("Cannot remove role", "This role does not exists");
            } elseif ($this->view_modal_current_user->getAllRoles()->count() <= 1) {
                $this->addError("Cannot remove role", "The user must have at least one role");
            } else {
                $this->view_modal_current_user->removeRole($this->remove_role["name"]);
                $this->updateListOfRolesAndPermissions();
                $this->closeRemoveRoleModal();
            }

            return;
        }

        $this->addError("Cannot remove role", "Failed to remove the selected role");
    }

    public function closeRemoveRoleModal()
    {
        $this->remove_role_modal_visible = false;
    }

    public function showAddPermissionModal()
    {
        $this->add_permission_modal_visible = true;
    }

    public function addPermission()
    {
        if ($this->new_permission !== null && $this->view_modal_current_user !== null) {
            if ($this->view_modal_current_user->hasPermissionTo($this->new_permission)) {
                $this->addError("Cannot add permission", "The user already has this permission");
            } elseif ($this->new_permission === 'none') {
                $this->addError("Cannot add permission", "You must select a permission");
            } elseif ( ! Permission::where('name', $this->new_permission)->exists()) {
                $this->addError("Cannot add permission", "This permission does not exists");
            } else {
                $this->view_modal_current_user->givePermissionTo($this->new_permission);
                $this->new_permission = 'none';
                $this->updateListOfRolesAndPermissions();
                $this->districtUpdated();
                $this->closeAddPermissionModal();
            }

            return;
        }

        $this->addError("Cannot add permission", "Failed to add the selected permission");
    }

    public function closeAddPermissionModal()
    {
        $this->add_permission_modal_visible = false;
    }

    public function showRemovePermissionModal()
    {
        $this->remove_permission_modal_visible = true;
    }

    public function requestPermissionRemoval(Permission $permission)
    {
        $this->remove_permission = $permission;

        $this->showRemovePermissionModal();
    }

    public function removePermission()
    {
        if ($this->remove_permission !== null && $this->view_modal_current_user !== null) {
            if ( ! $this->view_modal_current_user->hasPermissionTo($this->remove_permission)) {
                $this->addError("Cannot remove permission", "The user does not have this permission");
            } elseif ( ! Permission::where('name', $this->remove_permission['name'])->exists()) {
                $this->addError("Cannot remove permission", "This permission does not exists");
            } else {
                $this->view_modal_current_user->revokePermissionTo($this->remove_permission["name"]);
                $this->updateListOfRolesAndPermissions();
                $this->districtUpdated();
                $this->closeRemovePermissionModal();
            }

            return;
        }

        $this->addError("Cannot remove permission", "Failed to remove the selected permission");
    }

    public function closeRemovePermissionModal()
    {
        $this->remove_permission_modal_visible = false;
    }
}
