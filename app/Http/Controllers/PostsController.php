<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;

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
        // #### this is to store the image in the folder in public
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


    public function show(Post $post)
    {
        return view('posts.show')->with('post',$post);
    }


    public function edit(Post $post)
    {
        // ####### this is to go mainly to edit form
        return view('posts.edit')->with('post', $post);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        // ####### first make sure that the image is updated or not
        $data = $request->only(['title', 'description', 'content']);

        // ## if I have image file from edit form
        if($request->hasFile('image')){
            // #### this is to store the image in the folder in public
            $imageStore = $request->image->store('posts','public');

            // #### this to delete the image from the storage folder
            Storage::disk('public')->delete($post->image);

            // ## set the image in the array (data)
            $data['image'] = $imageStore;
        }

        // ### update the post
        $post->update($data);

        session()->flash('success','The post has been updated successfully');
        return redirect(route('posts.index'));
    }


    public function destroy($id)     // ==== model binding
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            // #### this to delete the image from the storage folder
            Storage::disk('public')->delete($post->image);

            // #### this delete to delete the post from the database
            $post->forceDelete();
            session()->flash('error','The post has been deleted successfully');
        } else {
            // #### this delete to put the post as a trashed post
            $post->delete();
            session()->flash('error','The post has been trashed successfully');
        }
        return redirect(route('posts.index'));
    }

    // ######### get all trashed posts
    public function trashedPosts(){
        $trashedPosts = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashedPosts);
    }

    // ######### restore trashed posts
    public function restoreTrashed($id){
        Post::withTrashed()->where('id',$id)->restore();
        session()->flash('success','The post has been restored successfully');
        return redirect(route('posts.index'));
    }
}
