<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoiLikesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->resource);
        return [
            "doi_searched"=>$this->resource->core_doi,
            "details"=> [
                "title_doi"=>$this->resource->core_title,
                "likes_count"=>$this->resource->likes,
                "dislikes_count"=>$this->resource->dislikes,
                "url_identifier"=>$this->resource->core_downloadUrl
            ],
        ];
    }
}
