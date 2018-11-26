<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;


class AuthController extends Controller
{

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('4boot');//-> accessToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function logout(){ 
        if(Auth::user())
        {
           Auth::user()->token()->revoke();
        }
        else
        {
            return response()->json([], 404); 
        }
    }

    public function usuario(){
        return Auth::user();
    }
}
