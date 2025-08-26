<?php

namespace App\Http\Requests\Member;

use App\Data\Comparison\ComparisonItemData;
use App\Data\Comparison\StoreComparisonData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComparisonRequest extends FormRequest
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

            'criteria_comparisons' => ['required', 'array'],
            'criteria_comparisons.*.item1_id' => ['required', 'integer', 'exists:criteria,id'],
            'criteria_comparisons.*.item2_id' => ['required', 'integer', 'exists:criteria,id'],
            'criteria_comparisons.*.value' => ['required', Rule::in($saatyScale)],

            'alternative_comparisons' => ['required', 'array'],
            'alternative_comparisons.*.criterion_id' => ['required', 'integer', 'exists:criteria,id'],
            'alternative_comparisons.*.item1_id' => ['required', 'integer', 'exists:alternatives,id'],
            'alternative_comparisons.*.item2_id' => ['required', 'integer', 'exists:alternatives,id'],
            'alternative_comparisons.*.value' => ['required', Rule::in($saatyScale)],
        ];
    }

    public function toDto()
    {
        $criteriaComparisons = [];
        foreach ($this->validated('criteria_comparisons', []) as $item) {
            $criteriaComparisons[] = new ComparisonItemData(
                item1Id: $item['item1_id'],
                item2Id: $item['item2_id'],
                value: $item['value']
            );
        }

        $alternativeComparisons = [];
        foreach ($this->validated('alternative_comparisons', []) as $item) {
            $alternativeComparisons[] = new ComparisonItemData(
                item1Id: $item['item1_id'],
                item2Id: $item['item2_id'],
                value: $item['value'],
                criterionId: $item['criterion_id']
            );
        }

        return new StoreComparisonData(
            periodId: $this->validated('period_id'),
            criteriaComparisons: $criteriaComparisons,
            alternativeComparisons: $alternativeComparisons
        );
    }
}
