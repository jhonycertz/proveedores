<?php

namespace App\Http\Controllers\API;

use App\Requeriment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\RequerimentResource;
use App\Http\Requests\RequerimentRequest;


class RequerimentController extends Controller
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
            return RequerimentResource::collection(Requeriment::orderBy('id','desc')->get());
        }
        
        $search = $request->input('search');
        $query = Requeriment::when($search, function($query) use ($search){
            return $query->where('name','like','%'. $search .'%');
        })
        ->orderBy('code','desc')
        ->orderBy('id','desc');
        return RequerimentResource::collection($query->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequerimentRequest $request)
    {
        $validated = $request->validated();
        return  new RequerimentResource(Requeriment::create($validated),201); //response()->json(Requeriment::create($validated),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requeriment  $requeriment
     * @return \Illuminate\Http\Response
     */
    public function show(Requeriment $requeriment)
    {
        return new RequerimentResource($requeriment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requeriment  $requeriment
     * @return \Illuminate\Http\Response
     */
    public function update(RequerimentRequest $request, Requeriment $requeriment)
    {
        $validated = $request->validated();
        $requeriment->update($validated);
        return new RequerimentResource($requeriment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requeriment  $requeriment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requeriment $requeriment)
    {
        $requeriment->delete();
        return response()->json([],204);
    }
}
