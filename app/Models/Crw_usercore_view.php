<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_usercore_view extends Model
{
    use HasFactory;

    public function coreuser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
