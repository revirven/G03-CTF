<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email:rfc,dns', 'max:50', 'unique:users,email'],
            'username' => ['required', 'alpha_dash', 'max:30', 'unique:users,username'],
            'password' => ['required', Password::min(6)->mixedCase()->numbers(), 'max:72'],
            're_password' => 'same:password'
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
            'email.max' => 'Email can only be 50 characters long.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'This email has already been taken.',

            'username.required' => 'Username is required.',
            'username.alpha_dash' => 'Username can only contain alpha-numeric characters, as well as dashes and underscores.',
            'username.max' => 'Email can only be 50 characters long.',
            'username.unique' => 'This username has already been taken.',

            'password.required' => 'Password is required',
            'password.max' => 'Password can only be 72 characters long',

            're_password.same' => 'Re-entered password must match the password above'
        ];
    }

    /**
    * The URI that users should be redirected to if validation fails.
    *
    * @var string
    */
    protected $redirectRoute = "user.register";
}
