<?php

namespace App\Http\Requests\Status;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true; // O ajusta según tus permisos
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:statuses,name,' . $this->route('status'),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del estado es obligatorio.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'name.unique' => 'Este estado ya existe.',
        ];
    }
}
