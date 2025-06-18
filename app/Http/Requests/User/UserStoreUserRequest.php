<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type_document_id' => ['required', 'exists:types,id'],
            'document' => ['required', 'string', 'max:255', 'unique:users,document'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'birthday' => ['nullable', 'date', 'before_or_equal:today'],
            'role_id' => ['required', 'exists:roles,id'],
            'status_id' => ['required', 'exists:statuses,id'],
            'collection_ids' => ['array'], // Para asociar colecciones al crear el usuario
            'collection_ids.*' => ['exists:collections,id'],
            'volume_ids' => ['array'], // Para asociar volúmenes al crear el usuario
            'volume_ids.*' => ['exists:volumes,id'],
        ];
    }
}
