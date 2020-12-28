<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    use HasFactory;

    protected $fillable = ['dark_mode'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
