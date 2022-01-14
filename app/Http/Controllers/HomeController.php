<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* ====== this construct function which used middleware (auth) to prevent anyone
              to enter all pages in this controller without authuntcations ====== */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    // ====== index function
    public function index()
    {
        $lastPost = Post::get()->last();
//        dd($lastPost);

        return view('frontEnd.index',[
            'lastPost' => $lastPost,
            'posts' => Post::all(),
//            'categories' => Category::all(),
//            'tags' => Tag::all()
        ]);
//        return view('frontEnd.index');
    }
}
