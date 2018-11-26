<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
        $reply = $this->route('reply');
        if($reply){
            return [
                'reply' => ['required'],
            ];
        }
        return [
            'reply' => ['required'],
            'question_id' => ['required','exists:questions,id'],
            ///'user_id' => ['required'],['exists:users,id'],
        ];

    }
}


