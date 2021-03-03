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
        return $this->belongsTo(Crw_search::class, 'crw_searchesID' ,'search_id');
    }

    public function core()
    {
        return $this->belongsTo(Crw_core::class, 'crw_coresID', 'core_id');
    }

}
