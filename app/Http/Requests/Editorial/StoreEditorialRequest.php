<?php

namespace App\Http\Requests\Editorial;

use Illuminate\Foundation\Http\FormRequest;

class StoreEditorialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:editorials,name'],
        ];
    }
}
