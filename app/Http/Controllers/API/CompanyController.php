<?php

namespace App\Http\Controllers\API;
use Mail;
use App\Requeriment;
use App\Company;
use App\Dates;
use App\Incidence;
use App\Document;
use App\Review;
use App\Mail\DateMail;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\IncidenceResource;
use App\Http\Resources\CompanyDocument;
use App\Http\Resources\Document As Docs;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\IncidenceRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Company::when($search, function($query) use ($search) {
            return $query->where('name','like','%'. $search .'%');
        })
        ->when($status, function($query) use ($status){
            return $query->where('status','like','%'. $status .'%');
        })
        ->orderBy('id','desc');
        return CompanyResource::collection($query->paginate(12));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function documents(Company $company)
    {
        return new CompanyDocument($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $validated = $request->validated();
        $company->update($validated['company']);
        $company->people()->update($validated['contact']);
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([],204);
    }

    public function reprobar(Company $company)
    {
        $company->update(['status' => 'RECHAZADA']);
        return new CompanyResource($company);
    }


    public function aprobarEmpresa(Company $company)
    {
        $company->update(['status' => 'APROBADA']);
        return new CompanyResource($company);
    }

    
    public function procesar(Company $company)
    {
        $company->procesar($company);
        return new CompanyResource($company);
    }

    public function aprobar(Company $company)
    {
        $company->aprobar(Auth::user());
        return new CompanyResource($company);
    }

    public function registrarIncidencia(IncidenceRequest $request, Company $company, Document $document){
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $incidence = Incidence::create($validated);
        $document->status = 'RECHAZADO';
        $document->save();
        return new IncidenceResource($incidence);
    }

    public function acceptDocument(Request $request){
        $id = $request->input('id');
        $user = Auth::user();
        $doc = Document::where('id', $id)
                        ->first();
        $doc->status = 'ACEPTADO';
        $doc->update();
        $review = new Review();
        $review->document_id = $id;
        $review->user_id = $user->id;
        $review->approved = 1;
        $review->save();
        return $doc;
    }
    public function rejectDocument(Request $request){
        $user = Auth::user();
        $id = $request->input('id');
        $doc = Document::where('id', $id)->first();
        $doc->status = 'RECHAZADO';
        $doc->update();
        $review = new Review();
        $review->document_id = $id;
        $review->user_id = $user->id;
        $review->approved = 0;
        $review->save();
        return new Docs($doc);
    }

    public function createDate(Request $request){
        $company = Company::find($request->input('company'));
        $user = Auth::user();
        $date = new Dates();
        $date->company = $request->input('company');
        $date->date = $request->input('dateNow');
        $date->created_by = $user->id;
        $date->attendant = $request->input('attendant');
        $date->attendant_mail  = $request->input('attendantMail');
        $date->attendant_phone = $request->input('phone');
        $date->save();
        Mail::to($company->email)->send(new DateMail($date));
        return $date;
    }

}
