<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreTagRequest extends FormRequest
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
            '*.tag' => ['string', 'required', 'max:255', 'unique:tags'],
            '*.tag_slug' => ['string', 'required', 'max:255', 'unique:tags'],
            // '*.created_at' => ['date_format:Y-m-d H:i:s', 'required'],
            // '*.updated_at' => ['date_format:Y-m-d H:i:s', 'nullable'],
        ];
    }

    // protected function prepareForValidation()
    // {
    //     $data = [];
    //     foreach($this->toArray() as $obj ){
    //         $obj['created_at'] = $obj['created_at'] ?? null;
    //         $obj['updated_at'] = $obj['updated_at'] ?? null;
    //         $data[] = $obj;
    //     }
    //     $this->merge($data);
    // }
}
