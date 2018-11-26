<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyTypeRequest extends FormRequest
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
        $type = $this->route('company_type');
        if($type){
            return [
                'type' => ['required','max:25',Rule::unique('company_types')->where(function($query) use(&$type){return $query->whereNull('deleted_at')->where('id','!=',$type->id); })],
                'requeriments.*.id' => ['required','exists:requeriments,id']
            ];
        }
        return [
          'type' => ['required','max:25', Rule::unique('company_types')->where(function($query){return $query->whereNull('deleted_at'); })],
          'requeriments.*.id' => ['required','exists:requeriments,id']
        ];
    }
}
