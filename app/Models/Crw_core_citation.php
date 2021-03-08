<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Crw_core_citation extends Model
{
    use HasFactory;

    public $fillable = ['crw_coresID', 'crw_citation_count'];


    public static function opencitations($core_doi)
    {
        $response = Http::get('https://opencitations.net/index/coci/api/v1/metadata/'.$core_doi);

        // dd($response->json());
        
        return $response->json();
    }

    public static function addToCoreCitation($core_id,$core_doi)
    {

        $response = Crw_core_citation::opencitations($core_doi);

        if($response){    
            Crw_core_citation::firstOrCreate([
                'crw_coresID' => $core_id,
                'crw_citation_count' => $response[0]['citation_count']
                ]);
        } else {
            Crw_core_citation::firstOrCreate([
                'crw_coresID' => $core_id,
                'crw_citation_count' => 0
                ]);
        }
    }

    public static function getCoreCitations()
    {
        $core_citations = Crw_core_citation::with(['core'])->get();

        foreach($core_citations as $cores)
        {
            $dois[] = $cores->core->core_doi;
        }
        
        $doiString = join('__', $dois);

        $response = Crw_core_citation::opencitations($doiString);

        // dd($response);
        return $response;
    }

    public function core()
    {
        return $this->belongsTo(Crw_core::class, 'crw_coresID', 'core_id');
    }
}
