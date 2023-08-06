<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash; //Hash class -> format password
use Session; //store class -> store session information data, about the user, across the requests
use App\Models\User; //user model class, for database operation
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderSubmitted;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderDueNotification;
use App\Models\order;
use Illuminate\Support\Facades\Notification;


class loginController extends Controller {
    
    //default function of login
    public function index() {
        
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    //function authenticate the user before logged in
    public function authenticate(Request $request) {
        
        //get the credentials
        $credentials = $request->validate([
            'email'     =>      'required|email:dns',
            'password'  =>      'required'
        ]);

        //login into the system based on the role of signed in user
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'Production'){

                //display notification if order due date (deliveryDateETA) is in 5 days
                $dueDate = Carbon::now()->addDays(5)->toDateString();
                $order = order::where('deliveryDateETA', $dueDate)->get();

                $prodUsers = User::where('role', 'Production')->get();

                foreach ($order as $orders) {
                    Notification::send($prodUsers, new OrderDueNotification($orders));
                }

                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('prod.mainWindow')->with(compact('notifications')); 
            }
            else if(Auth::user()->role == 'QC'){

                //display notification if order due date (deliveryDateETA) is in 5 days
                $dueDate = Carbon::now()->addDays(5)->toDateString();
                $order = order::where('deliveryDateETA', $dueDate)->get();

                $qcUsers = User::where('role', 'QC')->get();

                foreach ($order as $orders) {
                    Notification::send($qcUsers, new OrderDueNotification($orders));
                }

                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('qc.mainWindow')->with(compact('notifications')); 
            }
            else if(Auth::user()->role == 'Store'){

                //display notification if order due date (deliveryDateETA) is in 5 days
                $dueDate = Carbon::now()->addDays(5)->toDateString();
                $order = order::where('deliveryDateETA', $dueDate)->get();

                $storeUsers = User::where('role', 'Store')->get();

                foreach ($order as $orders) {
                    Notification::send($storeUsers, new OrderDueNotification($orders));
                }

                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('store.mainWindow')->with(compact('notifications')); 
            }
            else if(Auth::user()->role == 'Sales'){

                //display notification if order due date (deliveryDateETA) is in 5 days
                $dueDate = Carbon::now()->addDays(5)->toDateString();
                $order = order::where('deliveryDateETA', $dueDate)->get();

                $salesUsers = User::where('role', 'Sales')->get();

                foreach ($order as $orders) {
                    Notification::send($salesUsers, new OrderDueNotification($orders));
                }

                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('sales.mainWindow')->with(compact('notifications')); 
            }
            else {
                //the role of logged in user to client
                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('client.mainWindow')->with(compact('notifications'));
            }
        }
        return back()->with('loginError','Login failed!');
    }

    //function user logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    //redirect to main window page for Production personnel
    public function mainWindowProd() {
        //display unread notifications
        $notifications = auth()->user()->unreadNotifications;
        return view('prod.mainWindow', compact('notifications'));
    }
    //redirect to main window page for Sales personnel
    public function mainWindowSales() {
        //display unread notifications
        $notifications = auth()->user()->unreadNotifications;
        return view('sales.mainWindow', compact('notifications'));
    }
    //redirect to main window page for Store personnel
    public function mainWindowStore() {
        //display unread notifications
        $notifications = auth()->user()->unreadNotifications;
        return view('store.mainWindow', compact('notifications'));
    }
    //redirect to main window page for Quality Control personnel
    public function mainWindowQC() {
        //display unread notifications
        $notifications = auth()->user()->unreadNotifications;
        return view('qc.mainWindow', compact('notifications'));
    }
    //redirect to main window page for Client personnel
    public function mainWindowClient() {
        //display unread notifications
        $notifications = auth()->user()->unreadNotifications;
        return view('client.mainWindow', compact('notifications'));
    }
   
    //add time marked into notification table
    public function markNotification_(Request $request)
    {
        auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function($query) use ($request){
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

        return response()->noContent();
    }

}