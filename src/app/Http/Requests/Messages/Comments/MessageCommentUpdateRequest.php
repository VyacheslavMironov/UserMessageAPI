<?php

namespace App\Http\Requests\Messages\Comments;

use Illuminate\Foundation\Http\FormRequest;

class MessageCommentUpdateRequest extends FormRequest
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
            'message_id'    => ['required', 'numeric'],
            'user_id'       => ['required', 'numeric'],
            'text'          => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'id.required'           => 'Укажите id комментария!',
            'id.numeric'            => 'Ошибка типа!',
            'message_id.required'   => 'Укажите id сообщения!',
            'message_id.numeric'    => 'Ошибка типа!',
            'user_id.required'      => 'Укажите id пользователя!',
            'user_id.numeric'       => 'Ошибка типа!',
            'text.required'         => 'Введите текст комментария!',
        ];
    }
}
