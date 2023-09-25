<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:20',
            'gsm' => 'required|numeric|unique:users',
            'surname' => 'required|string|max:20',
            'twitter_address' => 'required|string|max:1000',
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
            'name.required'     => 'Name is required!',
            'password.required' => 'Password is required!',
            'gsm.required'      => 'GSM is required!',
            'surname.required'  => 'Surname is required!',
            'twitter_address.required' => 'Twitter address is required!'
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $validate_token = bin2hex(openssl_random_pseudo_bytes(32));
        $access_token   = hash('sha256', time().implode('',$this->all()));
        \request()->merge(['validate_token'=>$validate_token,'access_token'=>$access_token]);
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
