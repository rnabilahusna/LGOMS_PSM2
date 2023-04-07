<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Illuminate\Support\Facades\Auth; //laravel authentication class -> 


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loginPage');
    }

    public function registration()
    {
        return view('signUpPageStaff');
    }

    function validate_registration(Request $request){
        $request->validate([
            'name'      =>      'required',
            'email'     =>      'required|email|unique:users',
            'password'  =>      'required|min:6|max:16',
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'email'  =>  $data['email'],
            'password'  =>  Hash::make($data['password'])
        ]);

        return redirect('loginPage')->with('success', 'Registration Completed, now you can login');
    }


    function validate_login(Request $request){
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect('dashboard');
        }

        return redirect('loginPage')->with('success', 'Login details are not valid');
    }

    function dashboard(){
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect('loginPage')->with('success', 'Sorry, you are not allowed to access');
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect('loginPage');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
