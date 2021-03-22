<?php

namespace App\Http\Livewire\Admin\Clusters;

use App\Http\Livewire\NumberedTableComponent;
use App\Models\Cluster;
use Illuminate\Support\Str;
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
    public $header_view = 'components.admin.clusters.table-header';

    // Should be enough to display all districts in one page
    public $per_page = 30;

    // Add district
    public $add_modal_visible = false;
    public $add_modal_name;
    public $add_modal_abbreviation;

    protected $add_cluster_rules = [
        'add_modal_name'         => 'required|unique:clusters,name',
        'add_modal_abbreviation' => 'required|unique:clusters,abbreviation',
    ];

    protected $messages = [
        'add_modal_name.required'          => 'You must enter a cluster name.',
        'add_modal_name.unique'            => 'A cluster already has this name, please use a different name.',
        'add_modal_abbreviation.required'  => 'You must enter a cluster abbreviation.',
        'add_modal_abbreviation.unique'    => 'A cluster already has this abbreviation, please use a different abbreviation.',
        'edit_modal_name.required'         => 'You must enter a district name.',
        'edit_modal_name.unique'           => 'A cluster already has this name, please use a different name.',
        'edit_modal_abbreviation.required' => 'You must enter a cluster abbreviation.',
        'edit_modal_abbreviation.exists'   => 'A cluster already has this abbreviation, please use a different abbreviation.',
    ];

    // Edit district
    public $edit_modal_visible = false;
    public $edit_modal_current_cluster = null;
    public $edit_modal_name = null;
    public $edit_modal_original_name = null;
    public $edit_modal_abbreviation = null;

    // Delete district
    public $delete_modal_visible = false;
    public $delete_modal_current_cluster = null;
    public $delete_modal_name = null;
    public $delete_modal_number_of_assigned_districts = null; // The number of districts assigned to the cluster to be deleted

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
        return Cluster::query();
    }

    public function columns()
    {
        return [
            Column::make('Name')->sortable()->searchable(),
            Column::make('Abbreviation')->sortable(),
            Column::make('Manage')->view('admin.clusters.menu'),
        ];
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
        $this->add_modal_visible      = false;
        $this->add_modal_name         = '';
        $this->add_modal_abbreviation = null;
    }

    public function addCluster()
    {
        $this->validate($this->add_cluster_rules);

        Cluster::create(['name' => $this->add_modal_name, 'abbreviation' => Str::upper($this->add_modal_abbreviation)]);

        $this->closeAddModal();
    }

    // Edit district
    public function showEditModal(int $clusterId)
    {
        $this->resetErrorBag();
        $this->edit_modal_current_cluster = Cluster::find($clusterId);

        if ($this->edit_modal_current_cluster !== null) {
            $this->edit_modal_name          = $this->edit_modal_current_cluster->name;
            $this->edit_modal_original_name = $this->edit_modal_name;
            $this->edit_modal_abbreviation  = $this->edit_modal_current_cluster->abbreviation;
            $this->edit_modal_visible       = true;

            $this->emit('edit-modal-shown');
        }
    }

    public function closeEditModal()
    {
        $this->edit_modal_visible = false;
    }

    public function editCluster()
    {
        $edit_cluster_rules = [
            'edit_modal_name'         => [
                'required', Rule::unique('clusters', 'name')->ignore($this->edit_modal_current_cluster->id)
            ],
            'edit_modal_abbreviation' => [
                'required', Rule::unique('clusters', 'abbreviation')->ignore($this->edit_modal_current_cluster->id)
            ],
        ];
        $this->validate($edit_cluster_rules);

        $this->edit_modal_current_cluster->name         = $this->edit_modal_name;
        $this->edit_modal_current_cluster->abbreviation = $this->edit_modal_abbreviation;
        $this->edit_modal_current_cluster->save();

        $this->closeEditModal();
    }

    // Delete district
    public function showDeleteModal(int $clusterId)
    {
        $this->delete_modal_current_cluster = Cluster::find($clusterId);

        if ($this->delete_modal_current_cluster !== null) {
            $this->delete_modal_name                         = $this->delete_modal_current_cluster->name;
            $this->delete_modal_number_of_assigned_districts = $this->delete_modal_current_cluster->districts()->count();
            $this->delete_modal_visible                      = true;
        }
    }

    public function closeDeleteModal()
    {
        $this->delete_modal_visible         = false;
        $this->delete_modal_current_cluster = null;
    }

    public function deleteCluster()
    {
        if ($this->delete_modal_current_cluster !== null && $this->delete_modal_number_of_assigned_districts === 0) {
            $this->delete_modal_current_cluster->delete();

            $this->closeDeleteModal();
        }
    }
}
