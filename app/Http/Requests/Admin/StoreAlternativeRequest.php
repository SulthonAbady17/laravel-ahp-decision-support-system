<?php

namespace App\Http\Requests\Admin;

use App\Data\Alternative\AlternativeCreateData;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlternativeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:alternatives'],
            'details' => ['nullable', 'string'],
        ];
    }

    public function toDto(): AlternativeCreateData
    {
        return new AlternativeCreateData(
            name: $this->input('name'),
            details: $this->input('details'),
        );
    }
}
