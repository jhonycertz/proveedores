<?php

namespace App\Http\Controllers\API;
use App\Requeriment;
use App\CompanyType;
use App\Http\Resources\CompanyTypeResource;
use App\Http\Resources\CompanyTypeRequerimentResource;
use App\Http\Requests\CompanyTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('search');
        $query = CompanyType::when($type, function($query) use ($type){
            return $query->where('type','like','%'. $type .'%');
        })
        ->orderBy('id','desc');
        return CompanyTypeResource::collection($query->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyTypeRequest $request)
    {
        $validated = $request->validated();
        $company = CompanyType::create($validated);
        $requeriments = array_map(function(&$e) { return $e['id'];} ,$validated['requeriments']);
        $company->requeriments()->sync($requeriments);
        return response()->json(new CompanyTypeRequerimentResource($company),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyType $companyType)
    {
        return new CompanyTypeRequerimentResource($companyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyTypeRequest $request, CompanyType $companyType)
    {
        $validated = $request->validated();
        $companyType->update($validated);
        $requeriments = array_map(function(&$e) { return $e['id'];} ,$validated['requeriments']);
        $companyType->requeriments()->sync($requeriments);
        return new CompanyTypeRequerimentResource($companyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyType $companyType)
    {
        $companyType->delete();
        return response()->json([],204);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function requerimentAdd(CompanyType $companyType, Requeriment $requeriment)
    {
        $companyType->requeriments()->attach($requeriment);
        return new CompanyTypeRequerimentResource($companyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyType  $companyType
     * @return \Illuminate\Http\Response
     */
    public function requerimentRemove(CompanyType $companyType, Requeriment $requeriment)
    {
        $companyType->requeriments()->delete($requeriment);
        return new CompanyTypeRequerimentResource($companyType);
    }



}
