<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('frontEnd.blog.blogs',[
            'posts' => Post::all(),
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function search(Request $request){
        $searchWord = $request->search;

        // ###### Search Query ######
        $posts = Post::query()->where('title' , 'LIKE' , "%{$searchWord}%")
                              ->orWhere('description' , 'LIKE' , "%{$searchWord}%")->get();
        return view('frontEnd.blog.searchBlogs', [
            'searchPostResults' => $posts,
            'searchWord' => $searchWord,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::all()
        ]);
    }

    public function categoryBlogs($catID){
        $catPosts = Post::all()->where('category_id', $catID);
        $category = Category::find($catID);
        return view('frontEnd.blog.categoryBlogs', [
            'catPosts' => $catPosts,
            'category' => $category,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::all()
        ]);
    }

    public function tagBlogs($tagID){
        $tag = Tag::find($tagID);
        $tagPosts = $tag->posts;
        return view('frontEnd.blog.tagBlogs', [
            'tag' => $tag,
            'tagPosts' => $tagPosts,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::all()
        ]);
    }

    public function show($id){
        $post = Post::find($id);

        if($post){
            return view('frontEnd.blog.show', [
                'post' => $post,
                'categories' => Category::all(),
                'tags' => Tag::all(),
                'posts' => Post::all()
            ]);
        } else {
            return redirect('');
        }

    }
}
