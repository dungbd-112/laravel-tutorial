<?php

namespace App\Http\Requests;

use App\Enums\ResponseStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UpdateStoryRequest extends FormRequest
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
            'title' => [
                'bail',
                'max:255',
            ],
            'pages' => [
                'bail',
                'array',
            ],
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
            'array' => 'Invalid :attribute field.',
            'min:1' => 'Please add at least one :attribute',
            'max:255' => 'The :attribute field must be less than :max characters.'
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
                'success' => ResponseStatus::Fail,
                'error' => $errors,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY), 422);
    }
}