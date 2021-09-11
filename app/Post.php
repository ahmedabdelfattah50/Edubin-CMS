<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'category_id', 'content', 'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
