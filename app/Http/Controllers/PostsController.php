<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;

class PostsController extends Controller
{

    // ######### index function to return to index page
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    // ######### create function to return to create form
    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $imageStore = $request->image->store('posts','public');
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->postContent,
            'image' => $imageStore
        ]);

        // return success message in the index page
        session()->flash('success','The post has been created successfully');
        return redirect(route('posts.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Post $post)
    {
        // ####### this is to go mainly to edit form
        return view('posts.edit')->with('post', $post);
    }


    public function update(PostRequest $request, $id)
    {
        //
    }


    public function destroy(Post $post)     // ==== model binding
    {
        $post->delete();
        session()->flash('error','The post has been deleted successfully');
        return redirect(route('posts.index'));
    }
}
