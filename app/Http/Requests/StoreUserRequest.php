<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'ghana_card_id' => 'required|string|unique:users',
            'ghana_card_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'constituency_id' => 'required|exists:constituencies,id',
            'region_id' => 'required|exists:regions,id',
            'area' => 'required|string|max:255',
            'role' => 'required|in:user,constituency_admin,regional_admin,national_admin,application_admin',
        ];
    }
}
