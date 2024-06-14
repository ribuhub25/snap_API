<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreVariantRequest extends FormRequest
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
            '*.character_id' => ['required', 'integer','exists:characters,id'],
            '*.art' => ['required', 'string', 'max:255'],
            '*.art_filename' => ['required', 'string', 'max:255'],
            '*.rarity' => ['required', 'string', 'max:255'],
            '*.rarity_slug' => ['required', 'string', 'max:255'],
            '*.variant_order' => ['required', 'string', 'max:255'],
            '*.status' => ['required', 'string', 'max:255'],
            '*.full_description' => ['string', 'nullable'],
            '*.inker' => ['nullable', 'string', 'max:255'],
            '*.sketcher' => ['required', 'string', 'max:255'],
            '*.colorist' => ['nullable', 'string', 'max:255'],
            '*.possession' => ['nullable', 'numeric'],
            '*.usage_count' => ['nullable', 'numeric'],
            '*.ReleaseDate' => ['numeric'],
            '*.UseIfOwn' => ['nullable', 'string', 'max:255'],
            '*.PossesionShare' => ['required', 'string', 'max:255'],
            '*.UsageShare' => ['required', 'string', 'max:255'],
        ];
    }
    // protected function prepareForValidation()
    // {
    //     $data = [];
    //     foreach ($this->toArray() as $obj) {
    //         $obj['character_id'] = $obj['character_id'] ?? null;
    //         $data[] = $obj;
    //     }
    //     $this->merge($data);
    // }
}
