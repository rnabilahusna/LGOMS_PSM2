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
                $notifications = auth()->user()->unreadNotifications;
                return redirect()->intended('client.mainWindow')->with(compact('notifications'));
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
        $notifications = auth()->user()->unreadNotifications;
        return view('prod.mainWindow', compact('notifications'));
    }
    public function mainWindowSales() {
        $notifications = auth()->user()->unreadNotifications;
        return view('sales.mainWindow', compact('notifications'));
    }
    public function mainWindowStore() {
        $notifications = auth()->user()->unreadNotifications;
        return view('store.mainWindow', compact('notifications'));
    }
    public function mainWindowQC() {
        $notifications = auth()->user()->unreadNotifications;
        return view('qc.mainWindow', compact('notifications'));
    }
    public function mainWindowClient() {
        $notifications = auth()->user()->unreadNotifications;
        return view('client.mainWindow', compact('notifications'));
    }
   
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