<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCriteriaComparisonRequest extends FormRequest
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
        $saatyScale = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '1/2', '1/3', '1/4', '1/5', '1/6', '1/7', '1/8', '1/9'];

        return [
            'period_id' => ['required', 'integer', 'exists:selection_periods,id'],
            'criteria_comparisons' => ['present', 'array'],
            'criteria_comparisons.*.value' => ['required', Rule::in($saatyScale)],
            'criteria_comparisons.*.item1_id' => ['required', 'integer', 'exists:criteria,id'],
            'criteria_comparisons.*.item2_id' => ['required', 'integer', 'exists:criteria,id'],
        ];
    }
}
