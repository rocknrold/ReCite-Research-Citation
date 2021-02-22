<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Crw_core extends Model
{
    use HasFactory;
    protected $fillable = ['core_title', 'core_yearPublished', 
                            'core_fullTextIdentifier', 'core_description', 
                            'core_oai', 'core_downloadUrl'];

    public static function validateLibraryResponse($lookup)
    {
        $message = $lookup;

        // dd([$message, gettype($lookup), gettype($message)]);

        if($message[0]['status'] == 'OK') {
            return true;
        }else {
            return false;
        }
    }

    public function coresearch()
    {
        return $this->belongsToMany(Crw_search::class);
    }
}
