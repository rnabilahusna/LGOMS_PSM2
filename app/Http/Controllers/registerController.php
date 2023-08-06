<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Illuminate\Support\Facades\Auth; 
use App\Models\staff;
use App\Models\client;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

//class for user sign up the system by Sales personnel 
class registerController extends Controller {
    
    //index function that will call register.index file
    public function index() {
        
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
        
    }

    //function sign up user 'Staff' by Sales personnel
    public function store(Request $request) {

        //validate the data entered
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

       //encrypt password 
        $validatedData['password'] = Hash::make($validatedData['password']);

        //store the validated data into table 'Staff'
        staff::create($validatedData);

        //validate the data entered
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

        //encrypt password 
        $validatedData2['password'] = Hash::make($validatedData2['password']);

        //store the validated data into table 'User'
        User::create($validatedData2);

        
        //get the data name, email, and password for welcome email purposes
        //the email will provide the login credentials to the user tru the email
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        Mail::to($email)->send(new WelcomeMail($name,$email,$password));
        
        //return message if success
        return redirect('/register')->with('success','Registation successful! Do login the account.');

    }


    //function that will call for register staff page
    public function signUpPageClient()
    {
        return view('register.signUpPageClient');
    }

    //function sign up user 'Staff' by Sales personnel
    public function storeClient(Request $request) {

        //validate the data entered
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

       //encrypt password 
        $validatedData3['password'] = Hash::make($validatedData3['password']);
        //store the validated data into table 'client'
        client::create($validatedData3);

        //validate the data entered
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

        //encrypt password 
        $validatedData4['password'] = Hash::make($validatedData4['password']);
        //store the validated data into table 'User'
        User::create($validatedData4);

        //get the data name, email, and password for welcome email purposes
        //the email will provide the login credentials to the user tru the email
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        Mail::to($email)->send(new WelcomeMail($name,$email,$password));
        
        
        //return message if success
        return redirect('/register')->with('success','Registation successful! Do login the account.');

    }
}