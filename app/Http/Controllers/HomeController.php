<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class HomeController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(Auth::check()){
            view()->share('user',Auth::user());
            return redirect('trangchu');
        }
    }
}