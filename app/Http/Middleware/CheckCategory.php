<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class CheckCategory
{
    public function handle($request, Closure $next)
    {
        $categoriesCount = Category::all()->count();
        if($categoriesCount == 0){
            // return error message in the posts index page
            session()->flash('error','Please enter at least one Category to able to add new post.');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
