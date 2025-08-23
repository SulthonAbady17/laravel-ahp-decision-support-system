<?php

namespace App\Http\Requests\Admin;

use App\Data\Criterion\CriterionUpdateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCriterionRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('criteria')->ignore($this->route('criterion'))],
            'description' => ['nullable', 'string'],
        ];
    }

    public function toDto(): CriterionUpdateData
    {
        return new CriterionUpdateData(
            name: $this->validated('name'),
            description: $this->validated('description'),
        );
    }
}
