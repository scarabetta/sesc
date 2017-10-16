<?php

namespace App\Http\Controllers;

use Auth;
use Request;

use App\User;
use App\Rol;
use App\Fondo;

use App\Http\Requests as Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', ['usuarios' => $users]);
    }

    public function edit($id){

        $roles = Rol::all();
        $fondos = Fondo::all();
        $user = User::find($id);
        return view('users.edit', [
            'usuario' => $user, 
            'roles' => $roles,
            'fondos' => $fondos]);
    }
    
    public function add(){

        $roles = Rol::all();
        $fondos = Fondo::all();
        return view('users.add', [
            'roles' => $roles,
            'fondos' => $fondos
            ]
        );
    }
    
    public function delete($id){
      
        $user = User::find($id);    
        $user->delete();
        
        return redirect('users');
    }

    public function update($id){
        if (trim(Request::get('password')) == '') {
            $data = Request::except('password');
        }else{
            $data = Request::all();
            $data['password'] = bcrypt($data['password']);
        }

        $user = User::find($id);
        $user->update($data);
        return redirect('users')->with('alert-success','El usuario se actualizó con exito');
    }
    
    public function save(){

        $data = Request::all();
        $data['password'] = bcrypt($data['password']);
        
        try{
            $user = new User();
            $user->fillFields($data);
            $user->save();
        }catch(\Exception $e){
            return redirect('users/add')->with('alert-danger','Ocurrió un problema al crear el usuario: '. $e->getMessage());
        }
        
        return redirect('users')->with('alert-success','El usuario se creo con exito');
    }
}
