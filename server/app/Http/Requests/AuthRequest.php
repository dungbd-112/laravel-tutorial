<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class AuthRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => [
                'bail',
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'bail',
                'required',
            ]
        ];
    }


    /**
     * Custom message for validation
     * 
     * @return array
    */
    public function messages(): array
    {
        return [
            'required' => ':attribute field is required.',
            'email' => 'Invalid email address.',
            'max:255' => 'The :attribute field must be less than :max characters.',
        ];
    }


    /**
     * Custom validation error response
     * 
     * @return void
    */
    protected function failedValidation(Validator $validator) 
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'error' => $errors,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY), 422);
    }
}