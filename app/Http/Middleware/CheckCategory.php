<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCategory
{
    public function handle($request, Closure $next)
    {
        $categoriesCount = Category::all()->count();
        if($categoriesCount == 0){

            // return error message in the posts index page
            if(Auth::user()->isAdmin()){
                session()->flash('error','Please enter at least one Category to able to add new post.');
                return redirect(route('categories.index'));
            } else {
                session()->flash('error',"Sorry, you can't add the post because it must has at least one category which added by the admin of website.");
                return redirect(route('posts.index'));
            }
        }
        return $next($request);
    }
}
