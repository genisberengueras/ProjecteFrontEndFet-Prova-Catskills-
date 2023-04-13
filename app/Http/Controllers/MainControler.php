<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainControler extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function embassaments()
    {
        return view('embassaments');
    }
    public function comarques()
    {
        return view('comarques');
    }
    public function quiz()
    {
        return view('quiz');
    }
}
