<?php

namespace App\Http\Requests\V1\Order;

use Illuminate\Foundation\Http\FormRequest;

class getOrderRequest extends FormRequest
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
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'User Name',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id' => 'Invalid user_id Passed',
        ];
    }
}
