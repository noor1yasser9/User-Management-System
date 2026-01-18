<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans('messages.validation.username_or_email_required'),
            'password.required' => trans('messages.validation.password_required'),
            'password.min' => trans('messages.validation.password_min'),
        ];
    }
}
