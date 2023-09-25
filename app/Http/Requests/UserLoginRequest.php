<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'    => 'Email is required!',
            'password.required' => 'Password is required!',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        \request()->only(['email','password']);
        return $this->all();
    }

    public function failedValidation(Validator $validator)
    {
        if(\request()->is('api/*')){
            throw new HttpResponseException(response()->json([
                'success'   => 'erorr',
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]),400);
        }
    }

}
