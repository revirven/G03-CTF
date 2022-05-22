<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email:rfc,dns', 'max:50'],
            'password' => ['required']
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email address.',
            
            'password.required' => 'Password is required.',
            'password.max' => 'Password can only be 72 characters long.'
        ];
    }

     /**
    * The URI that users should be redirected to if validation fails.
    *
    * @var string
    */
    protected $redirectRoute = 'user.login';
}
