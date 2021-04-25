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

/**
 * Class Table provides the accounts table in the admin centre as a livewire component
 *
 * @package App\Http\Livewire\Admin\Districts
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

    // Adjust the size and positioning of the manage column
    public function thClass($attribute)
    {
        if ($attribute == 'manage') {
            return 'w-28 text-center';
        }

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'manage') {
            return 'w-28 text-center';
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
}
