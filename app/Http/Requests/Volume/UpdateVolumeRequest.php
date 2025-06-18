<?php

namespace App\Http\Requests\Volume;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVolumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('volumes')->ignore($this->volume)],
            'collection_id' => ['sometimes', 'required', 'exists:collections,id'],
        ];
    }
}
