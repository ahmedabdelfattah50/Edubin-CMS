<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function trashedPosts(){
//        return $this->hasMany(Post::onlyTrashed());
        return Post::onlyTrashed()->where('user_id', $this->id)->get();
//        return $this->posts()->whereNotNull('deleted_at')->get();
    }

    public function getAvatar(){
        if(! $this->profile->avatar){
            return 'images/default_avatar.png';
        }
        return $this->profile->avatar;
    }
}
