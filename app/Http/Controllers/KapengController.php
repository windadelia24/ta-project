<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KapengController extends Controller
{
    function index(){
        return view('dashboard');
    }
}
