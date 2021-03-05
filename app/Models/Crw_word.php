<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_word extends Model
{
    use HasFactory;
    protected $fillable = ['crw_search_id', 'crw_description', 'crw_synonym'];

    public static function createWordDefinition($id, $description, $synonym)
    {
        $newKeyword = Crw_word::firstOrCreate([
            'crw_search_id' => $id,
            'crw_description' => $description,
            'crw_synonym' => $synonym,
        ]);
    }

    public function search(){
    	return $this->belongsTo(Crw_search::class, 'crw_search_id', 'search_id');
    }
}
