<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required|min:3',
            'body'  => 'required',
            'system'=> 'required',
            'type'	=> 'required',
            'urgency'=> 'required',
            'image1'=>	'mimes:jpeg,gif,png',
            'image2'=>	'mimes:jpeg,gif,png',
            'image3'=>	'mimes:jpeg,gif,png',
        ];
    }
}
