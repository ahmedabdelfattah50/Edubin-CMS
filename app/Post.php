<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'user_id', 'category_id', 'accepted', 'request_restore', 'content', 'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function newPosts(){
        return Post::all()->where('accepted', 'no');
    }

    // ######### get posts in page of requests restore
//    const function requestsTrashedPosts(){
//        $requestedTrashedPosts = Post::onlyTrashed()->where('request_restore', 'yes')->get();
//        return $requestedTrashedPosts->count();
//    }
}
