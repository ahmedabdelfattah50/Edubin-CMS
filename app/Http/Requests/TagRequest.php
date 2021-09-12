<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:tags'
        ];
    }

    public function attributes()
    {
        return[
            // ###### to use this name you must first unused the messages function
            'name' => 'Tage name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.unique' => 'Sorry, this name is already been taken before',
        ];
    }
}
