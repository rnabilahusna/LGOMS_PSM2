<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Illuminate\Support\Facades\Auth; 

class registerController extends Controller {
    
    public function index() {
        
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name'      =>      'required|max:255',
            'ICNo'      =>      'required|min:12|max:14', 
            'citizenship' =>    'required',
            'contactNum'  =>    'required|min:10|max:12',
            'staffID'   =>      'required',
            'department'=>      'required',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
        ]);

       
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        
        return redirect('/login')->with('success','Registation successful! Do login the account.');

    }
}