<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* ====== this construct function which used middleware (auth) to prevent anyone
              to enter all pages in this controller without authuntcations ====== */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ====== index function
    public function index()
    {
        return view('home');
    }
}
