<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RequerimentTypeResource;

class RequerimentResource extends JsonResource
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
            'id' =>  $this->id,
            'name' =>  $this->name,
            'code'=>  $this->code,
            'required' =>  $this->required,
            'requeriment_type' => new RequerimentTypeResource($this->requerimentType)
        ];
    }
}

