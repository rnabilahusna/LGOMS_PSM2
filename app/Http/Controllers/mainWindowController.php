<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainWindowController extends Controller {
    
    public function index() {
        return view('mainWindow.index');
    }
}