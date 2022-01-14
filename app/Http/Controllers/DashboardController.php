<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index',[
            'usersCount' => User::all()->count(),
            'postsCount' => Post::all()->count(),
            'categoriesCount' => Category::all()->count(),
            'tagsCount' => Tag::all()->count(),
            'trashedPostsCount' => Post::onlyTrashed()->count()
        ]);
    }

    public function homeWriterDash(){
        return view('dashboard.homeWriterDash');
    }
}
