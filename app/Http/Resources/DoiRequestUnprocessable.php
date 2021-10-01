<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoiRequestUnprocessable extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "error"=>"wrong request format please see documentation",
            "fixes"=>["specify do ?doi=<doi identifier>","check documentation"]
        ];
    }
}
