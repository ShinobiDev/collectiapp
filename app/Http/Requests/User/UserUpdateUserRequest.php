<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type_document_id' => ['sometimes', 'required', 'exists:types,id'],
            'document' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'confirmed', Password::defaults()], // Nullable para que no sea obligatorio actualizarla
            'birthday' => ['nullable', 'date', 'before_or_equal:today'],
            'role_id' => ['sometimes', 'required', 'exists:roles,id'],
            'status_id' => ['sometimes', 'required', 'exists:statuses,id'],
            'collection_ids' => ['array'],
            'collection_ids.*' => ['exists:collections,id'],
            'volume_ids' => ['array'],
            'volume_ids.*' => ['exists:volumes,id'],
        ];
    }
}
