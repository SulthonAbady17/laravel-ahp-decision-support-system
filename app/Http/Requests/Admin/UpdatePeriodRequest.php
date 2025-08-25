<?php

namespace App\Http\Requests\Admin;

use App\Data\Period\PeriodUpdateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeriodRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', Rule::in(['draft', 'active', 'completed'])],
        ];
    }

    public function toDto(): PeriodUpdateData
    {
        return new PeriodUpdateData(
            name: $this->validated('name'),
            status: $this->validated('status'),
            start_date: $this->validated('start_date'),
            end_date: $this->validated('end_date'),
        );
    }
}
