<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonStoreUpdateRequest extends FormRequest
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
            'name' => ['required','string','max:255','min:3'],
            'surname' => ['required','string','max:255','min:3'],
            'date_birth' => ['required','date'],
            'name_mother' => ['required','string','max:255','min:3'],
            'city_id' => ['exists:cities,id','integer','required','min:1'],
            'description' => ['required', 'string', 'max:255', 'min:10'],
            'group_id' => ['required','exists:groups,id','integer'],
            'photos' => ['required'],
            'photos.*' => ['image','max:20480'],
        ];
    }
}
