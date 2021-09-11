<?php

namespace App\Http\Livewire\MyParticipants;

use App\Actions\Fortify\UserValidationRules;
use App\Http\Livewire\NumberedTableComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kdion4891\LaravelLivewireTables\Column;
use Laravel\Jetstream\ConfirmsPasswords;

/**
 * Class Table provides the participants table as a livewire component
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

    public $per_page = 30;

    // Adjust the size and positioning of the manage column
    public function thClass($attribute)
    {
        if ($attribute == 'award') {
            return 'w-12 text-center';
        }

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'award') {
            return 'w-12 text-center';
        }

        return null;
    }

    public function query()
    {
        $districtAccess = Auth::user()->getDistrictAccess();

        if (in_array('*', $districtAccess,)) {
            return User::with('district')->permission('qsa.has');
        }

        return User::with('district')->permission('qsa.has')->whereIn('district_id', $districtAccess);
    }

    public function columns()
    {
        return [
            Column::make('Name', 'full_name')->sortable()->searchable(),
            Column::make('District', 'district.name')->sortable()->searchable(),
            Column::make('Award')->view('my-participants.menu'),
        ];
    }

    public function models()
    {
        $models = parent::models();
        $models->select('users.*');

        return $models;
    }

    // Open user's award page
    public function viewUserAward($id)
    {
        if ($id !== null) {
            Session::put('award_user', $id);
        } else {
            return;
        }

        Session::put('award_redirect_route', 'my-participants.show');
        $this->redirect('/award');
    }
}
