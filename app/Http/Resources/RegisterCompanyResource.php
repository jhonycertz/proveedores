<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterCompanyResource extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'identity' => $this->identity,
            'address'  => $this->address,
            'phone'    => $this->phone,
            'status'   => $this->status,
            'customer' => $this->customer()->get(),
            'people'    => $this->people()->get(),
            'companyType' => $this->companyType()->get()
        ];
    }
}
