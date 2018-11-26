<?php

namespace App\Http\Resources;
use  App\Http\Resources\RequerimentResource;
use  App\Http\Resources\DocumentTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ClientDocument extends JsonResource
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
            'document_type_id' => new DocumentTypeResource($this->documentType),
            'file_path' =>  asset(Storage::url($this->file_path)),
            'id' => $this->id,
            'name' => $this->name,
            'requeriment' => new RequerimentResource($this->requeriment),
            'incidences' => $this->incidences,
            'status' => $this->status,
            'incidence_path' => route('company.incidecia',[ 'company' => $this->client->company_id,  'document' => $this->id ])       
        ];
    }
}
