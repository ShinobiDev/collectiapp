<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;

class StoreCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:collections,name'],
            'category_id' => ['required', 'exists:categories,id'],
            'gender_id' => ['required', 'exists:genders,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'editorial_id' => ['required', 'exists:editorials,id'],
            'date' => ['nullable', 'date'], // Si 'Date' es una fecha de publicación o similar
        ];
    }
}
