<?php

namespace App\Http\Controllers\API;

use App\DocumentType;
use App\Requeriment;
use App\Http\Resources\DocumentTypeResource;
use App\Http\Requests\DocumentTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('search');
        $query = DocumentType::when($type, function($query) use ($type){
            return $query->where('type','like','%'. $type .'%');
        })
        ->orderBy('id','desc');
        return DocumentTypeResource::collection($query->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeRequest $request)
    {
        $validated = $request->validated();
        return response()->json(DocumentType::create($validated),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        return new DocumentTypeResource($documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentTypeRequest  $request
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeRequest $request, DocumentType $documentType)
    {
        $validated = $request->validated();
        $documentType->update($validated);
        return response()->json($documentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        return response()->json([],204);
    }
}
