<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Illuminate\Support\Facades\Auth; 
use App\Models\staff;
use App\Models\client;

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
            'department'=>      'required',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
            'staffID'   =>      'required',
            'role'   =>      'required'
        ]);

       
        $validatedData['password'] = Hash::make($validatedData['password']);

        staff::create($validatedData);

        $validatedData2 = $request->validate([
            'name'      =>      'required|max:255',
            'ICNo'      =>      'required|min:12|max:14', 
            'citizenship' =>    'required',
            'contactNum'  =>    'required|min:10|max:12',
            'department'=>      'required',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
            'staffID'   =>      'required',
            'role'   =>      'required'
        ]);

        $validatedData2['password'] = Hash::make($validatedData2['password']);

        User::create($validatedData2);
        
        
        return redirect('/register')->with('success','Registation successful! Do login the account.');

    }


    public function signUpPageClient()
    {
        return view('register.signUpPageClient');
    }


    public function storeClient(Request $request) {

        $validatedData3 = $request->validate([
            'name'      =>      'required|max:255',
            'contactNum'  =>    'required|min:10|max:12',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
            'role'   =>      'required',
            'buyerCode' =>  'required',
            'authorizationCodeOrName'   =>  'required',
            'buyerAddress'   =>  'required',
            'buyerCorrespondentOrName'   =>  'required',
            'buyerName'   =>  'required',
            'buyerSectionCodeOrName'   =>  'required',
            'originCountry'   =>  'required',
        ]);

       
        $validatedData3['password'] = Hash::make($validatedData3['password']);

        client::create($validatedData3);

        $validatedData4 = $request->validate([
            'name'      =>      'required|max:255',
            'contactNum'  =>    'required|min:10|max:12',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
            'role'   =>      'required',
            'buyerCode' =>  'required',
            'authorizationCodeOrName'   =>  'required',
            'buyerAddress'   =>  'required',
            'buyerCorrespondentOrName'   =>  'required',
            'buyerName'   =>  'required',
            'buyerSectionCodeOrName'   =>  'required',
            'originCountry'   =>  'required',
        ]);

        $validatedData4['password'] = Hash::make($validatedData4['password']);
        User::create($validatedData4);
        
        
        return redirect('/register')->with('success','Registation successful! Do login the account.');

    }
}