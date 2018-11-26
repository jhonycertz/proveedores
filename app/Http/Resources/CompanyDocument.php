<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClientDocument;
use App\Http\Resources\ApprovalResource;
use Illuminate\Support\Facades\Storage;

class CompanyDocument extends JsonResource
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
            'customer' => new CustomerCompany($this->customer),
            'people'   => $this->people,
            'company_type' => new CompanyTypeResource($this->companyType),
            'catalogo_path' => Storage::url($this->catalogo_path),
            'documents' => ClientDocument::collection($this->client->documents()->orderBy('status')->get()),
            'aprobaciones' => ApprovalResource::collection($this->aprobaciones()->orderBy('created_at')->get())
        ];
    }
}
