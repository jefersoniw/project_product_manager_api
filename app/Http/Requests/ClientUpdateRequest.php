<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'name' => 'string',
            'cpf' => 'numeric|min_digits:11|max_digits:11',
            'address' => 'string',
            'photo' => 'file|extensions:jpg,png,jpeg',
            'sex' => 'min:1|max:1'
        ];
    }
}
