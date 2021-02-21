<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_word extends Model
{
    use HasFactory;

    public function search()
    {
        return $this->hasOne(Crw_search::class);
    }
}
