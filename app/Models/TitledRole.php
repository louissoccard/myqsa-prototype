<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class TitledRole extends Role
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
}
