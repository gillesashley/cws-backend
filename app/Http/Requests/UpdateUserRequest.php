<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'phone' => ['sometimes', 'string', 'max:20', Rule::unique('users')->ignore($this->user->id)],
            'date_of_birth' => 'sometimes|date',
            'constituency_id' => 'sometimes|exists:constituencies,id',
            'area' => 'sometimes|string|max:255',
            'role' => 'sometimes|in:user,constituency_admin,regional_admin,national_admin,application_admin',
        ];
    }
}
