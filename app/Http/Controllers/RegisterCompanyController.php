<?php

namespace App\Http\Controllers;
use DB;
use Mail;
use App\Company;
use App\CompanyType;
use App\User;
use App\Mail\CompanyRegistered;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterCompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Resources\RegisterCompanyResource;
use App\Http\Resources\CompanyTypeResource;

class RegisterCompanyController extends Controller
{

    protected function store(RegisterCompanyRequest $request)
    {
        $data = json_encode($request->company);
        $data = json_decode($data);
        $companyType = CompanyType::where('id', $data->company_type_id)->first();
        $data->company_type_name = $companyType->type;
        Mail::to($data->email)->send(new CompanyRegistered('user', $data));
        $admins = User::where('role_id', 1)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new CompanyRegistered('admin', $data));
        }
        $validated = $request->validated();
        $company = Company::createWithFile($validated);
        return new RegisterCompanyResource($company);
    }

    protected function index()
    {
        $types = CompanyType::all();
        return view('welcome.register',compact('types')); 
    }

    protected function companyTypes()
    {
        return CompanyTypeResource::collection(CompanyType::all());
    }
}
