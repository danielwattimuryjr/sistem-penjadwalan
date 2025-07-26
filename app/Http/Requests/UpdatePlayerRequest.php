<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlayerRequest extends FormRequest
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
        $playerId = $this->route('player')->id ?? null;

        return [
            'name' => ['required', 'string', 'max:100'],
            'jersey_number' => [
                'required',
                'integer',
                'min:0',
                'max:99',
                Rule::unique('players', 'jersey_number')->ignore($playerId),
            ],
            'position' => ['required', 'in:PG,SG,SF,PF,C'],
        ];
    }
}
