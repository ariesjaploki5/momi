<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if(Auth::user() && Auth::user()->type == 'admin'){
            return redirect('dashboard');
        }
        if(Auth::user() && Auth::user()->type == 'doctor'){
            return redirect('doctorhome');
        }
        if(Auth::user() && Auth::user()->type == 'donor'){
            return redirect('donorhome');
        }
        if(Auth::user() && Auth::user()->type == 'candidate'){
            return redirect('candidatehome');
        }

        if(Auth::user() && Auth::user()->type == 'staff'){
            return redirect('staffhome');
        }
        
        if(Auth::user() && Auth::user()->type == 'client'){
            return redirect('clienthome');
        }

        if(Auth::user() && Auth::user()->type == 'recipient'){
            return redirect('recipienthome');
        }
        if(Auth::user() && Auth::user()->type == 'nurse'){
            return redirect('nursehome');
        }
        if(Auth::user() && Auth::user()->type == 'midwife'){
            return redirect('midwifehome');
        }
    }
}
