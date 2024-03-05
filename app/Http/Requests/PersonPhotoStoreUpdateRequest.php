<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonPhotoStoreUpdateRequest extends FormRequest
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
            'photo' => [ 'image','max:20480' ],
            'person_id' => ['exists:persons,id','integer'],
        ];
    }
}
