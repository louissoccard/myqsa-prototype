<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\NumberedTableComponent;
use Kdion4891\LaravelLivewireTables\Column;
use Spatie\Permission\Models\Role;

/**
 * Class Table provides the roles table in the admin centre as a livewire component
 *
 * @package App\Http\Livewire\Admin\Roles
 */
class Table extends NumberedTableComponent
{
    // Set the default sort direction, this is used to calculate the number for each row
    public $sort_direction = 'asc';
    public $original_sort_direction = 'asc';

    // Set the default row to be sorted, again used to calculate the number for each row
    public $sort_attribute = 'title';
    public $original_sort_attribute = 'title';

    public $per_page = 30;

    // Adjust the size and positioning of the title column
    public function thClass($attribute)
    {
        if ($attribute == 'title') {
            return 'w-64';
        } elseif ($attribute == 'name') {
            return 'hidden';
        }

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'title') {
            return 'w-64';
        } elseif ($attribute == 'name') {
            return 'hidden';
        }

        return null;
    }


    public function query()
    {
        return Role::query();
    }

    public function columns()
    {
        return [
            Column::make('Title')->sortable()->searchable()->view('admin-centre.roles.title'),
            Column::make('Name')->searchable(),
            Column::make('Description'),
        ];
    }
}
