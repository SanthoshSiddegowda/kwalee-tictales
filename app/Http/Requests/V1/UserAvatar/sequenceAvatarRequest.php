<?php

namespace App\Http\Requests\V1\UserAvatar;

use Illuminate\Foundation\Http\FormRequest;

class sequenceAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['exists:App\Models\User,id'],
            'items.*' => ['exists:App\Models\UserAvatar,item_id'],
        ];
    }
}
