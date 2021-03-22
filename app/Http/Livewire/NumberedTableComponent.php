<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Kdion4891\LaravelLivewireTables\TableComponent;

class NumberedTableComponent extends TableComponent
{
    public $row_numbers = array();
    public $original_sort_attribute = 'id';
    public $original_sort_direction = 'desc';

    public function mount()
    {
        parent::mount();
    }

    public function rowNumbers()
    {
        $models = $this->query();

        if (Str::contains($this->sort_attribute, '.')) {
            $relationship   = $this->relationship($this->sort_attribute);
            $sort_attribute = $this->attribute($models, $relationship->name, $relationship->attribute);
        } else {
            $sort_attribute = $this->original_sort_attribute;
        }

        foreach ($models->orderBy($sort_attribute, $this->original_sort_direction)->get() as $key => $district) {
            $this->row_numbers[$district->id] = $key + 1;
        }

        return $this->row_numbers;
    }

    public function tableView()
    {
        return view('laravel-livewire-tables::table', [
            'columns'     => $this->columns(),
            'models'      => $this->models()->paginate($this->per_page),
            'row_numbers' => $this->rowNumbers(),
        ]);
    }
}
