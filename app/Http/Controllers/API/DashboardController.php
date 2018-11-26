<?php

namespace App\Http\Controllers\API;

use App\IncidenceType;
use App\Http\Resources\IncidenceTypeResource;
use App\Http\Requests\IncidenceTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CroneJobsController;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\Document;
use App\Incidence;
use App\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        CroneJobsController::checkCroneJobs();
        $notifications = Document::where('status','PENDIENTE')
                                ->orderBy('created_at', 'desc')
                                ->with('requeriment')
                                ->take(20)
                                ->get();
        $notifications->load(['client' => function($q) {
                         	$q->with('company');
                   	}]);
        return $notifications;
       
    }
    public function getLogged(){
        $user = Auth::user();
        $user = User::where('id', $user->id)->with('role')->first();
        return $user->role->charge;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidenceTypeRequest $request)
    {
        $validated = $request->validated();
        return response()->json(IncidenceType::create($validated),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncidenceType  $incidenceType
     * @return \Illuminate\Http\Response
     */
    public function show(IncidenceType $incidenceType)
    {
        return new IncidenceTypeResource($incidenceType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IncidenceType  $incidenceType
     * @return \Illuminate\Http\Response
     */
    public function update(IncidenceTypeRequest $request, IncidenceType $incidenceType)
    {
        $validated = $request->validated();
        $incidenceType->update($validated);
        return response()->json($incidenceType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IncidenceType  $incidenceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncidenceType $incidenceType)
    {
        $incidenceType->delete();
        return response()->json([],204);
    }

    public function saveIncidence(Request $request){
        $user = Auth::user();
        $incidence = new Incidence();
        $incidence->description = $request->input('description');
        $incidence->incidence_type_id = $request->input('incidence_type_id');
        $incidence->document_id = $request->input('document_id');
        $incidence->user_id = $request->input('incidence_type_id');
        $incidence->save();
        return $incidence;
    }

    public function getMessages(){
        $messages = Question::where('status', 'pendiente')
                            ->with('client')
                            ->take(20)
                            ->get();
        $messages->load(['client' => function($q) {
                         	$q->with('company');
                   	}]);
        return $messages;
    }
}
