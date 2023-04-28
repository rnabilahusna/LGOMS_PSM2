<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Illuminate\Support\Facades\Auth;

class loginController extends Controller {
    
    public function index() {
        
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request) {
        
        $credentials = $request->validate([
            'email'     =>      'required|email:dns',
            'password'  =>      'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mainWindow');
        }

        return back()->with('loginError','Login failed!');
    }


}