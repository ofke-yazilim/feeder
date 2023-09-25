<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TwitUpdateRequest extends FormRequest
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
            'twitter_title' => 'required|string|max:141',
            'twitter_text' => 'required|string|max:141'
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
            'twitter_title.required'    => 'Twitter title is required!',
            'twitter_text.required'    => 'Twitter content is required!',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        \request()->only(['twitter_text','twitter_title']);
        \request()->request->remove('_token');
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
