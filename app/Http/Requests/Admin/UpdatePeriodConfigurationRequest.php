<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeriodConfigurationRequest extends FormRequest
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
            // Pastikan 'criteria' adalah array, dan setiap ID di dalamnya ada di tabel 'criteria'
            'criteria' => ['nullable', 'array'],
            'criteria.*' => ['integer', 'exists:criteria,id'],

            // Lakukan hal yang sama untuk 'alternatives'
            'alternatives' => ['nullable', 'array'],
            'alternatives.*' => ['integer', 'exists:alternatives,id'],
        ];
    }
}
