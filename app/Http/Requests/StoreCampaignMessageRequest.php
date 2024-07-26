<?php

namespace App\Http\Requests;

use App\Models\CampaignMessage;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', CampaignMessage::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'constituency_id' => 'required|exists:constituencies,id',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
