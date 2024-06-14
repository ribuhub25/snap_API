<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'character_id' => $this->character_id,
            'art' => $this->art,
            'art_filename' => $this->art_filename,
            'rarity' => $this->rarity,
            'rarity_slug' => $this->rarity_slug,
            'variant_order' => $this->variant_order,
            'status' => $this->status,
            'full_description' => $this->full_description,
            'inker' => $this->inker,
            'sketcher' => $this->sketcher,
            'colorist' => $this->colorist,
            'possession' => $this->possession,
            'usage_count' => $this->usage_count,
            'ReleaseDate' => $this->ReleaseDate,
            'UseIfOwn' => $this->UseIfOwn,
            'PossesionShare' => $this->PossesionShare,
            'UsageShare' => $this->UsageShare,
        ];
    }
}
