<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\RequerimentType;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $roles = Role::with('charge')->get();
        return $roles;
       
    }
    public function getRoles()
    {   
        $roles = Role::where('id', '!=', 1)->with('charge')->get();
        return $roles;
       
    }
    public function getRoleById(Request $request)
    {   
        $id = $request->input('id');
        $rol = Role::where('id',$id)->with('charge')->first();
        return $rol;
       
    }
    public function getChargesTypes()
    {   
        $rol = RequerimentType::get();
        return $rol;
       
    }
    public function storeRol(Request $request)
    {   
        $rol = new Role();
        $rol->role = $request->input('role');
        $rol->charge = $request->input('charge');
        $rol->save();
        return $rol;       
    }
    public function updateRole(Request $request)
    {   
        $rol = Role::where('id', $request->input('id'))->first();
        $rol->role = $request->input('role');
        $rol->charge = $request->input('charge');
        $rol->update();
        return $rol;       
    }
    public function deleteRol(Request $request)
    {   
        $rol = Role::where('id', $request->input('id'))->first();
        $rol->delete();
        return $rol;       
    }

    public function getUsers(){
        //User::where('id', '!=', 1)->get();
        return User::with('role')->get();
    }
    public function getAllRoles(){
        return Role::with('charge')->get();
    }
    public function getUserById(Request $request){
        return User::where('id',$request->input('id'))->with('role')->first();
    }
    public function storeUser(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();
        return $user;
    }
    public function updateUser(Request $request){
        $user = User::where('id', $request->input('id'))->first();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->update();
        return $user;
    }
    public function deleteUser(Request $request){
        $user = User::where('id', $request->input('id'))->first();
        $user->delete();
        return $user;
    }
    
}
