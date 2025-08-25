<?php

namespace App\Http\Requests\Admin;

use App\Data\User\UserUpdateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user'))],
            'role' => ['required', Rule::in(['admin', 'member'])],
        ];
    }

    public function toDto(): UserUpdateData
    {
        return new UserUpdateData(
            name: $this->validated('name'),
            email: $this->validated('email'),
            role: $this->validated('role'),
        );
    }
}
