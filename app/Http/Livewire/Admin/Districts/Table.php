<?php

namespace App\Http\Livewire\Admin\Districts;

use App\Http\Livewire\NumberedTableComponent;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Kdion4891\LaravelLivewireTables\Column;

/**
 * Class Table provides the districts table in the admin centre as a livewire component
 *
 * @package App\Http\Livewire\Admin\Districts
 */
class Table extends NumberedTableComponent
{
    // Set the default sort direction, this is used to calculate the number for each row
    public $sort_direction = 'asc';
    public $original_sort_direction = 'asc';

    // Set the default row to be sorted, again used to calculate the number for each row
    public $sort_attribute = 'name';
    public $original_sort_attribute = 'name';

    // Add the buttons and modals that appear in the section before the table
    public $header_view = 'components.admin-centre.districts.table-header';

    // Should be enough to display all districts in one page
    public $per_page = 30;

    // Add district
    public $add_modal_visible = false;
    public $add_modal_name;
    public $add_modal_cluster_id;

    protected $add_district_rules = [
        'add_modal_name'       => 'required|unique:districts,name',
        'add_modal_cluster_id' => 'required|exists:clusters,id',
    ];

    protected $messages = [
        'add_modal_name.required'        => 'You must enter a district name.',
        'add_modal_name.unique'          => 'A district already has this name, please use a different name.',
        'add_modal_cluster_id.required'  => 'You must select a district cluster.',
        'add_modal_cluster_id.exists'    => 'You must select a valid district cluster.',
        'edit_modal_name.required'       => 'You must enter a district name.',
        'edit_modal_name.unique'         => 'A district already has this name, please use a different name.',
        'edit_modal_cluster_id.required' => 'You must select a district cluster.',
        'edit_modal_cluster_id.exists'   => 'You must select a valid district cluster.',
    ];

    // Edit district
    public $edit_modal_visible = false;
    public $edit_modal_current_district = null;
    public $edit_modal_name = null;
    public $edit_modal_original_name = null;
    public $edit_modal_cluster_id = null;

    // Delete district
    public $delete_modal_visible = false;
    public $delete_modal_current_district = null;
    public $delete_modal_name = null;
    public $delete_modal_number_of_assigned_users = null; // The number of users assigned to the district to be deleted

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
        return District::with('cluster');
    }

    public function columns()
    {
        return [
            Column::make('Name')->sortable()->searchable(),
            Column::make('Cluster', 'cluster.name')->sortable(),
            Column::make('Manage')->view('admin-centre.districts.menu'),
        ];
    }

    /* Previously, the cluster name appeared as the district name when sorting by cluster
     * This fixes it, but I don't know how :(
     *
     * You can use SQL to rename the clusters.name column, but Laravel doesn't like that
     * Somehow using the select statement works! I think it removes the left join from the ThanksYajra trait but still works in the table
     */
    public function models()
    {
        $models = parent::models();
        $models->select('districts.*');

        return $models;
    }

    // Add district
    public function showAddModal()
    {
        $this->resetErrorBag();
        $this->add_modal_visible = true;

        $this->emit('add-modal-shown');
    }

    public function closeAddModal()
    {
        $this->add_modal_visible    = false;
        $this->add_modal_name       = '';
        $this->add_modal_cluster_id = null;
    }

    public function addDistrict()
    {
        $this->validate($this->add_district_rules);

        District::create(['name' => $this->add_modal_name, 'cluster_id' => $this->add_modal_cluster_id]);

        $this->closeAddModal();
    }

    // Edit district
    public function showEditModal(int $districtId)
    {
        $this->resetErrorBag();
        $this->edit_modal_current_district = District::find($districtId);

        if ($this->edit_modal_current_district !== null) {
            $this->edit_modal_name          = $this->edit_modal_current_district->name;
            $this->edit_modal_original_name = $this->edit_modal_name;
            $this->edit_modal_cluster_id    = $this->edit_modal_current_district->cluster->id;
            $this->edit_modal_visible       = true;

            $this->emit('edit-modal-shown');
        }
    }

    public function closeEditModal()
    {
        $this->edit_modal_visible = false;
//        $this->edit_modal_current_district = null;
//        $this->edit_modal_name             = '';
//        $this->edit_modal_original_name    = '';
//        $this->edit_modal_cluster_id       = null;
    }

    public function editDistrict()
    {
        $edit_district_rules = [
            'edit_modal_name'       => [
                'required', Rule::unique('districts', 'name')->ignore($this->edit_modal_current_district->id)
            ],
            'edit_modal_cluster_id' => 'required|exists:clusters,id',
        ];
        $this->validate($edit_district_rules);

        $this->edit_modal_current_district->name       = $this->edit_modal_name;
        $this->edit_modal_current_district->cluster_id = $this->edit_modal_cluster_id;
        $this->edit_modal_current_district->save();

        if (Auth::user()->district()->is($this->edit_modal_current_district)) {
            $this->emit('users-district-name-changed', $this->edit_modal_current_district->name);
        }

        $this->closeEditModal();
    }

    // Delete district
    public function showDeleteModal(int $districtId)
    {
        $this->delete_modal_current_district = District::find($districtId);

        if ($this->delete_modal_current_district !== null) {
            $this->delete_modal_name                     = $this->delete_modal_current_district->name;
            $this->delete_modal_number_of_assigned_users = $this->delete_modal_current_district->users()->count();
            $this->delete_modal_visible                  = true;
        }
    }

    public function closeDeleteModal()
    {
        $this->delete_modal_visible          = false;
        $this->delete_modal_current_district = null;
    }

    public function deleteDistrict()
    {
        if ($this->delete_modal_current_district !== null && $this->delete_modal_number_of_assigned_users === 0) {
            $this->delete_modal_current_district->delete();

            $this->closeDeleteModal();
        }
    }
}
