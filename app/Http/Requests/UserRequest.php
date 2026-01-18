<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
    $userId = $this->route('id');
    $this->merge(['id'=>$userId]);

    return [
        'id' => ['nullable', 'exists:users,id'],
        'name' => ['required', 'string', 'max:255'],
        'username' => [
            'required',
            'string',
            'max:255',
            Rule::unique('users', 'username')->ignore($userId),
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($userId),
        ],
        'age' => ['required', 'integer', 'min:1', 'max:150'],
        'password' => $userId
            ? ['nullable', 'string', 'min:6']
            : ['required', 'string', 'min:6'],
    ];
}

    public function messages(): array
    {
        return [
            'name.required' => trans('messages.validation.name_required'),
            'username.required' => trans('messages.validation.username_required'),
            'username.unique' => trans('messages.validation.username_unique'),
            'email.required' => trans('messages.validation.email_required'),
            'email.email' => trans('messages.validation.email_valid'),
            'email.unique' => trans('messages.validation.email_unique'),
            'age.required' => trans('messages.validation.age_required'),
            'age.integer' => trans('messages.validation.age_integer'),
            'age.min' => trans('messages.validation.age_min'),
            'age.max' => trans('messages.validation.age_max'),
            'password.required' => trans('messages.validation.password_required'),
            'password.min' => trans('messages.validation.password_min'),
        ];
    }
}
