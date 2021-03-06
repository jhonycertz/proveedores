<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
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
            'company.name' => ['required','max:50'],
            'company.identity' => ['required','max:50'],
            'company.address' => ['required','max:300'],
            'company.phone' => ['required','max:30'],
            'company.email' => ['required','max:50'],
            'company.catalogo_path'  => ['required','max:2048'],
            'company.company_type_id'  => ['required','exists:company_types,id'],
            'contact.name'  => ['required','max:50'],
            'contact.email' => ['required','max:50'],
            'contact.phone' => ['required','max:30'],
            'contact.role' => ['required','max:50'],
            'customers.*.name' => ['max:50'],
            'customers.*.phone' => ['max:30']
        ];
    }
}
