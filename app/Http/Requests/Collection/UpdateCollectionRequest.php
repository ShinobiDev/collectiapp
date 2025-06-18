<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('collections')->ignore($this->collection)],
            'category_id' => ['sometimes', 'required', 'exists:categories,id'],
            'gender_id' => ['sometimes', 'required', 'exists:genders,id'],
            'author_id' => ['sometimes', 'required', 'exists:authors,id'],
            'editorial_id' => ['sometimes', 'required', 'exists:editorials,id'],
            'date' => ['nullable', 'date'],
        ];
    }
}
