<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApprovalResource extends JsonResource
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
            'company' => $this->company,
            'user' =>  $this->user,
            'admin' => $this->admin,
            'created_at' => $this->created_at
        ];
    }
}
