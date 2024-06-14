<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreCharacterRequest extends FormRequest
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
            '*.name' => ['required', 'string', 'max:255'],
            '*.type' => ['required', 'string', 'max:255'],
            '*.cost' => ['required', 'numeric'],
            '*.power' => ['required', 'numeric'],
            '*.ability' => ['string', 'max:255', 'nullable'],
            '*.flavor' => ['string','max:255', 'nullable'],
            '*.art' => ['required', 'string', 'max:255'],
            '*.alternate_art' => ['string', 'max:255', 'nullable'],
            '*.url' => ['required', 'string', 'max:255'],
            '*.status' => ['required', 'string', 'max:255'],
            '*.carddefid' => ['required', 'string', 'max:255'],
            '*.source' => ['required', 'string', 'max:255'],
            '*.source_slug' => ['required', 'string', 'max:255'],
            '*.rarity' => ['string', 'max:255', 'nullable'],
            '*.rarity_slug' => ['string', 'max:255', 'nullable'],
            '*.difficulty' => ['string', 'max:255', 'nullable'],
            '*.sketcher' => ['string', 'max:255','nullable'],
            '*.inker' => ['string', 'max:255', 'nullable'],
            '*.colorist' => ['string', 'max:255','nullable'],
        ];
    }
}
