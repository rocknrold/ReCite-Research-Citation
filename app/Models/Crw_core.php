<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_core extends Model
{
    use HasFactory;

    public function coresearch()
    {
        return $this->belongsToMany(Crw_search::class);
    }
}
