<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Crw_core extends Model
{
    use HasFactory;
    protected $fillable = ['core_title', 
                            'core_yearPublished', 
                            'core_description', 
                            'core_oai', 
                            'core_downloadUrl'
                            ];

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

    public static function corePaginationSearch($keyword, $page)
    {
        $access_key = config('services.secrets.core');

        $query = "title:(".$keyword.")";

        // dd([$query, gettype($query), $page, gettype($page)]);
    
        $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='. $access_key .'',[
                ["query" => $query,
                "page" => $page,
                "pageSize" => 20,
                "scrollId" => "",]
            ]);

        return $response->json();
    }

    public static function coreFilterYearSearch($keyword, $yearFrom, $yearTo, $page=1)
    {
        $access_key = config('services.secrets.core');

        // $query = "title:(".$keyword.")";
        $query = "title:(".$keyword.") AND year:".$yearFrom." TO ".$yearTo."";

        // dd([$query, gettype($query), $page, gettype($page),$yearFrom,$yearTo]);
    
        $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='. $access_key .'',[
                ["query" => $query,
                "page" => $page,
                "pageSize" => 20,
                "scrollId" => "",]
            ]);

        return $response->json();
    }

    public static function addToCore($title,$year,$oai,$url,$description)
    {
        $result = Crw_core::where('core_oai', $oai)->first();

        if ($result) {
            $getCreateId = $result->core_id;          
        } else {
            $newWord = Crw_core::create([
                'core_title' => $title,
                'core_yearPublished' => $year ,
                'core_description' => $description,
                'core_oai' => $oai,
                'core_downloadUrl' => $url,
            ]);
            $getCreateId = $newWord->id; 
        }

        return $getCreateId;       
    }


    public function coresearch()
    {
        return $this->belongsToMany(Crw_search::class);
    }
}
