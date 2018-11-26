<?php

namespace App\Http\Controllers\API;

use App\IncidenceType;
use App\Http\Resources\IncidenceTypeResource;
use App\Http\Requests\IncidenceTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dates;
use App\Company;
use Mail;
use App\Mail\ChangeDateMail;

class DatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDates()
    {   
       $dates = Dates::with('company')->get();
       $dates = json_decode(json_encode($dates));
       $classes = array('orange', 'purple', 'green', 'red', 'yellow', 'pink');
       $response = array();
       foreach ($dates as $key => $date) {
           if($date->company != null){

               /*$response[$key]->id = $date->id;
               $response[$key]->startDate = $date->date;
               $response[$key]->title = $date->company->name;*/
               $response[$key]['id'] = $date->id;
               $response[$key]['startDate'] = $date->date;
               $response[$key]['title'] = 'Cita con la empresa '. $date->company->name;
               $response[$key]['classes'] = $classes[$date->company->company_type_id];
               $response[$key] = (object) $response[$key];
            }
        }
       return $response;
    }

    public function updateDate(Request $request){
        $date = Dates::where('id', $request->input('id'))->with('company')->first();
        $company = Company::findOrFail($date->company);
        $date->date = $request->input('newdate');
        $date->update();
        //Enviar mail
        Mail::to($company->email)->send(new ChangeDateMail($date));
        return $date;
    }
    public function getOnlyOne(Request $request){
        return Dates::findOrFail($request->input('id'));
    }   
    public function updateAttendant(Request $request){
        $date = Dates::findOrFail($request->input('id'));
        $date->attendant = $request->input('attendant');
        $date->attendant_mail = $request->input('attendant_mail');
        $date->attendant_phone = $request->input('attendant_phone');
        $date->update();
        return $date;
    }   
}
