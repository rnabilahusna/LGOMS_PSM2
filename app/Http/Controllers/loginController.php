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

            if(Auth::user()->role == 'Production'){
                return redirect()->intended('prod.mainWindow');
            }
            else if(Auth::user()->role == 'QC'){
                return redirect()->intended('qc.mainWindow');
            }
            else if(Auth::user()->role == 'Store'){
                return redirect()->intended('store.mainWindow');
            }
            else if(Auth::user()->role == 'Sales'){
                return redirect()->intended('sales.mainWindow');
            }
            else {
                return redirect()->intended('client.mainWindow');
            }
        }
        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function mainWindowProd() {
        return view('prod.mainWindow');
    }
    public function mainWindowSales() {
        return view('sales.mainWindow');
    }
    public function mainWindowStore() {
        return view('store.mainWindow');
    }
    public function mainWindowQC() {
        return view('qc.mainWindow');
    }
    public function mainWindowClient() {
        return view('client.mainWindow');
    }
   


}