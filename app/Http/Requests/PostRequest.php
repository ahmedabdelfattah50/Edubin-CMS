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

    public function messages()
    {
        return [
            'title.required' => 'The title is required',
            'description.required' => 'The description is required',
            'categoryID.required' => 'The category ID is required',
            'postContent.required' => 'The post content is required',
            'image.required' => 'The image is required',
        ];
    }
}
