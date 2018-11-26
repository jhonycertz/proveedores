<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequerimentRequest extends FormRequest
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
             'name' => ['required','max:300'],
             'code' => ['required','max:20'], 
             'required' => ['required','boolean'],
             'requeriment_type_id'  => ['required','exists:requeriment_types,id']
        ];
    }
}
