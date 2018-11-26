<?php

namespace App\Http\Controllers;

use App\IncidenceType;
use App\Http\Resources\IncidenceTypeResource;
use App\Http\Requests\IncidenceTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Question;
use App\Document;
use App\Incidence;
use App\User;
use App\Client;
use App\Company;
use Carbon\Carbon;

class CroneJobsController extends Controller
{
    public static function checkCroneJobs()
    {   
        //if (!Cache::has('made')) {
        if (Cache::has('made')) {
            Cache::remember('made', 1500, function() 
            {
                CroneJobsController::checkUsers();
                return true;
            });
        }
       
    }
    public static function checkUsers(){
        
        $diff = Carbon::today()->subMonths(2)->toDateString();
        $clients = Client::where('created_at', '<=', $diff )->with(['company', 'documents'])->get();
        foreach ($clients as $key => $client) {
            if($client->company->status != 'APROBADA'){ //Colocar APROBADA y subir el proceso
                if ($client->documents != '[]') {
                    CroneJobsController::deleteFiles($client->documents);
                }
                $company = Company::findOrFail($client->company_id);
                $company->delete();
                $client->delete();
            }
        }
        return true;
    }

    public static function deleteFiles($documents){
        foreach ($documents as $document) {
            $path = str_replace('storage', 'public', $document->file_path);
            Storage::delete($path);
            $doc = Document::findOrFail($document->id);
            $doc->delete();
        }
        return true;
    }
   
}
