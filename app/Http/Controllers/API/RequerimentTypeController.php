<?php

namespace App\Http\Controllers\API;

 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RequerimentType;
use App\Http\Resources\RequerimentTypeResource;
use App\Http\Requests\RequerimentTypeRequest;



class RequerimentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->input('page') == 'all')
        {
            return RequerimentTypeResource::collection(RequerimentType::orderBy('id','desc')->get());
        }
        
        $type = $request->input('search');
        $query = RequerimentType::when($type, function($query) use ($type){
            return $query->where('type','like','%'. $type .'%');
        })
        ->orderBy('id','desc');
        return RequerimentTypeResource::collection($query->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequerimentTypeRequest $request)
    {
        $validated = $request->validated();
        return response()->json(RequerimentType::create($validated),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequerimentType  $requerimentType
     * @return \Illuminate\Http\Response
     */
    public function show(RequerimentType $requerimentType)
    {
        return new RequerimentTypeResource($requerimentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequerimentType  $requerimentType
     * @return \Illuminate\Http\Response
     */
    public function update(RequerimentTypeRequest $request, RequerimentType $requerimentType)
    {
        $validated = $request->validated();
        $requerimentType->update($validated);
        return response()->json($requerimentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequerimentType  $requerimentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequerimentType $requerimentType)
    {
        $requerimentType->delete();
        return response()->json([],204);
    }
}
