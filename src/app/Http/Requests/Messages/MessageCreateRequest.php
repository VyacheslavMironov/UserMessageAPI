<?php

namespace App\Http\Requests\Messages;

use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
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
            'owner_id'      => ['required', 'numeric'],
            'text'          => ['required', 'string'],
            'rule'          => ['nullable'],
            'access_users'  => ['nullable'],
        ];
    }
    public function messages()
    {
        return [
            'owner_id.required' => 'Укажите id владельца сообщения!',
            'owner_id.numeric'  => 'Ошибка типа!',
            'text.required'     => 'Поле text обязательно для заполнения!',
            'text.string'       => 'Ошибка типа!',
        ];
    }
}
