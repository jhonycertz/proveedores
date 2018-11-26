<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncidenceRequest extends FormRequest
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
            'description'  => ['required'],
            'incidence_type_id'=> ['required','exists:incidence_types,id'],
            'document_id'=> ['required','exists:documents,id'],
            ///'user_id'=> ['required','exists:users,id'],
            //'requeriment_company_id'=> ['required','exists:requeriment_companies,id'],
        ];
    }
}