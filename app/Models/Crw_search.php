<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_search extends Model
{
    use HasFactory;

    public function word()
    {
        return $this->hasOne(Crw_word::class);
    }

    public function coresearch()
    {
        return $this->belongsToMany(Crw_core::class);
    }
}
