<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $fillable = ['user_id', 'about', 'avatar', 'linkedin', 'facebook', 'twitter', 'instagram'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
