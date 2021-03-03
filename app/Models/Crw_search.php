<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class Crw_search extends Model
{
    use HasFactory;
    protected $fillable = ['search_keyword', 'search_frequency'];

    public static function popularSearches()
    {
        $popular = Crw_search::orderBy('search_frequency', 'DESC')
                ->take(5)
                ->get();
        
        $keywords = [];

        foreach($popular as $word)
        {
            $keywords[] = $word['search_keyword'];
        }
               
        return $keywords;
    }

    public static function saveSearch($keyword)
    {
        $result = Crw_search::where('search_keyword', $keyword)->first();
        
        if ($result) {
            Crw_search::where('search_id', $result->search_id )->update(['search_frequency' => $result->search_frequency + 1]);
            $getCreateId = $result->search_id;          
        } else {
            $newWord = Crw_search::create([
                'search_keyword' => $keyword,
                'search_frequency' => 1,
            ]);
            $getCreateId = $newWord->id; 
        }

        return $getCreateId;
    }

    public static function checkUserWord($keyword, $lookup)
    {
        // $message = json_decode($lookup, true);
        $message = $lookup;

        if(isset($message['error'])){
            return false;
        }

        return true; 
    }

    public static function dictionaryLookup($keyword)
    {
        $access_key = config('services.secrets.word');
        $app_id = config('services.secrets.wordapp');
        
        $response = Http::withHeaders([
                "Accept" => "application/json",
                "app_id" => $app_id,
                "app_key"=> $access_key
        ])->get('https://od-api.oxforddictionaries.com/api/v2/entries/en-gb/'.$keyword.'?strictMatch=false');
        
        // dd($response->json());

        return $response->json();
    }

    public function word()
    {
        return $this->hasOne(Crw_word::class, 'crw_search_id', 'search_id');
    }

    public function coresearch()
    {
        return $this->hasMany(Crw_cores_search::class, 'crw_searchesID', 'search_id');
    }
}
