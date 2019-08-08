<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserPost extends FormRequest
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
            'firstname'     => 'required|string',
            'lastname'      => 'required|string',
            'birthday'      => 'required|date',
            'email'         => 'required|string|email|unique:user',
            'country'       => 'required',
            'phone'         => 'required|string',
            'reportSubject' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required'     => 'This field is required.',
            'lastname.required'      => 'This field is required.',
            'birthday.required'      => 'This field is required.',
            'email.required'         => 'This field is required.',
            'country.required'       => 'This field is required.',
            'phone.required'         => 'This field is required.',
            'reportSubject.required' => 'This field is required.',
            'email.unique'           => 'Member with this email already exists.',
        ];
    }
}
