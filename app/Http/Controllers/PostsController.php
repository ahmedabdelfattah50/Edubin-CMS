<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    // ######### construct function on the controller
    public function __construct(){
        $this->middleware('CheckCategory')->only('create');
    }

    // ######### index function to return to index page
    public function index()
    {
        $posts = Post::all()->where('accepted', 'yes');
        return view('dashboard.posts.index')->with('posts', $posts);
    }

    // ######### getNewPosts function to return new posts into index page
    public function getNewPosts()
    {
        $posts = Post::all()->where('accepted', 'no');
        return view('dashboard.posts.index')->with('posts', $posts);
    }

    // ######### create function to return to create form
    public function create()
    {
        return view('dashboard.posts.create')->with('categories', Category::all())
                                        ->with('tags', Tag::all());
    }

    // ######### Store function to store data in the dataBase
    public function store(PostRequest $request)
    {
//        dd($request->all());
        // #### this is to store the image in the folder in public
        $imageStore = $request->image->store('posts','public');

        if(auth()->user()->isAdmin()){
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'category_id' => $request->categoryID,
                'accepted' => 'yes',
                'content' => $request->postContent,
                'image' => $imageStore
            ]);
        } else {
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'category_id' => $request->categoryID,
                'content' => $request->postContent,
                'image' => $imageStore
            ]);
        }

        /* this to achieve the relationship between posts and tags
           and store data in posts_tags table this relationship is many to many */
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        // return success message in the index page
        session()->flash('success','The post has been created successfully');
        return redirect(route('posts.index'));
    }


    public function show(Post $post)
    {
        $post = Post::withTrashed()->where('id',$post->id)->first();
        return view('dashboard.posts.show')->with('post',$post);
    }

    public function showTrashedPost($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        return view('dashboard.posts.show')->with('post',$post);
    }


    public function edit(Post $post)
    {
        // ####### this is to go mainly to edit form
        return view('dashboard.posts.edit', [
                'post' => $post,
                'tags' => Tag::all(),
                'categories' => Category::all()
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        // ####### first make sure that the image is updated or not
        $data = $request->all();
//        dd($data);

        // ## if I have image file from edit form
        if($request->hasFile('image')){
            // #### this is to store the image in the folder in public
            $imageStore = $request->image->store('posts','public');

            // #### this to delete the image from the storage folder
            Storage::disk('public')->delete($post->image);

            // ## set the image in the array (data)
            $data['image'] = $imageStore;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        // ### update the post
        $post->update($data);

        // return success message in the posts index page
        session()->flash('success','The post has been updated successfully');
        return redirect(route('posts.index'));
    }


    public function destroy($id)     // ==== model binding
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            // #### this to delete the image from the storage folder
            Storage::disk('public')->delete($post->image);

            // #### this forceDelete function to force website delete the post from the database
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
        return view('dashboard.posts.index', ['posts' => $trashedPosts,
            'trashedPosts' => 'trash']);
    }

    // ######### restore trashed posts
    public function restoreTrashed($id){
        Post::withTrashed()->where('id', $id)->update(['request_restore' => 'no']);
        Post::withTrashed()->where('id',$id)->restore();
        // return success message in the posts index page
        session()->flash('success','The post has been restored successfully');
        return redirect(route('posts.index'));
    }

    // ######### restore trashed posts
    public function requestToRestorePost($id){
        $post = Post::withTrashed()->where('id',$id);
        $post->update(['request_restore' => 'yes']);
        // return success message in the posts index page
        session()->flash('success','The request of restored post is sent successfully');
        return redirect(route('posts.index'));
    }

    // ######### chancel restore trashed posts
    public function chancelRequestToRestorePost($id){
        $post = Post::withTrashed()->where('id',$id);
        $post->update(['request_restore' => 'no']);
        // return success message in the posts index page
        session()->flash('warning','The request of is chancel successfully');
        return redirect(route('posts.index'));
    }

    // ######### get my posts in the page
    public function myPosts(){
        $posts = Post::all()->where('user_id', Auth()->user()->id);
        return view('dashboard.posts.index', [
            'posts' => $posts,
            'myPosts' => "myPosts"
        ]);
    }

    // ######### get my trashed posts in the page
    public function myTrashedPosts(){
        $trashedPosts = Post::onlyTrashed()->where('user_id', Auth()->user()->id)->get();
        return view('dashboard.posts.index', [
            'posts' => $trashedPosts,
            'trashedPosts' => $trashedPosts,
            'myTrashedPosts' => "myTrashedPosts"
        ]);
    }

    // ######### get posts in page of requests restore
    public function requestsTrashedPosts(){
        $requestedTrashedPosts = Post::onlyTrashed()->where('request_restore', 'yes')->get();
        return view('dashboard.posts.index', [
            'posts' => $requestedTrashedPosts,
//            'trashedPosts' => $requestedTrashedPosts,
            'myTrashedPosts' => "myTrashedPosts"
        ]);
    }

    public function sendEmail(){
        return view('dashboard.email.sendEmail');
    }

    public function getLastPostOfUser(){
        // ####### get all writers in the database
        $users = User::where('role' , 'writer')->get();

        foreach ($users as $user){
            $userPosts = Post::where('user_id', $user->id)->get();

            foreach ($userPosts as $userPost){

                    if( $userPost == $userPosts->last() ){
                        $userLastPost = $userPosts->last();

                        $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                        $postCreatedDate = Carbon::createFromFormat('Y-m-d', $userLastPost->created_at->format('Y-m-d'));
                        $diff_in_days = $currentDate->diffInDays($postCreatedDate);
                        $userEmail = $user->email;

                        echo "<br>" . "user Id: " . $user->id . " last Post Id: " . $userLastPost->id . " >>>>> " . $diff_in_days;

                        // #### if the user last blog created since one week the task scheduler send him a notify email
                        if($diff_in_days > 7){
                            // #### send the email to the user

                            echo " Email: " . $userEmail . "<br>";

//                    $userLastPost->update(['title' => "## RERTwewerewW"]);
                            //                Mail::To($userEmail)->send(new WriterAlertMail($user));
                        }
                    }

                /*
                $userLastPost = $userPosts->last();

                $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                $postCreatedDate = Carbon::createFromFormat('Y-m-d', $userLastPost->created_at->format('Y-m-d'));
                $diff_in_days = $currentDate->diffInDays($postCreatedDate);
                $userEmail = $user->email;

                // #### if the user last blog created since one week the task scheduler send him a notify email
                if($diff_in_days > 7){
                    // #### send the email to the user

                    dd($userLastPost);

//                    $userLastPost->update(['title' => "## RERTwewerewW"]);
    //                Mail::To($userEmail)->send(new WriterAlertMail($user));
                }*/
            }


        }

//        dd(count($userPosts));


    }
}
