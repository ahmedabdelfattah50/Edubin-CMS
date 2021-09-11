<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:posts',
            'description' => 'required',
            'categoryID' => 'required',
            'postContent' => 'required',
            'image' => 'required|image'
        ];
    }
}
