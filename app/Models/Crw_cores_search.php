<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_cores_search extends Model
{
    use HasFactory;

    protected $fillable = ['crw_coresID', 'crw_searchesID'];

    public function search()
    {
        return $this->hasMany(Crw_search::class);
    }

    public function core()
    {
        return $this->hasMany(Crw_core::class);
    }

}
