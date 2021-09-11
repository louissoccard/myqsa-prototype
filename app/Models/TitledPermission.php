<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class TitledPermission extends Permission
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
}
