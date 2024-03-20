<?php

namespace App\Http\Requests\Messages;

use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
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
            'id'            => ['required', 'numeric'],
            'text'          => ['required'],
            'rule'          => ['nullable'],
            'access_users'  => ['nullable'],
        ];
    }
    public function messages()
    {
        return [
            'id.required'   => 'Поле id обязательно для заполнения!',
            'id.numeric'    => 'Ошибка типа!',
            'text.required' => 'Поле text обязательно для заполнения!',
        ];
    }
}
