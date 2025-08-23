<?php

namespace App\Http\Requests\Admin;

use App\Data\Criterion\CriterionCreateData;
use Illuminate\Foundation\Http\FormRequest;

class StoreCriterionRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:criteria'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function toDto(): CriterionCreateData
    {
        return new CriterionCreateData(
            name: $this->validated('name'),
            description: $this->validated('description'),
        );
    }
}
