<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crw_word extends Model
{
    use HasFactory;
    protected $fillable = ['crw_searchID', 'crw_description', 'crw_synonym'];

    public static function createWordDefinition($id, $description, $synonym)
    {
        $newKeyword = Crw_word::firstOrCreate([
            'crw_searchID' => $id,
            'crw_description' => $description,
            'crw_synonym' => $synonym,
        ]);
    }

    public function search()
    {
        return $this->hasOne(Crw_search::class);
    }
}
