<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VariantResource;
use App\Http\Resources\TagResource;

class CharacterResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type,
            'cost' => $this->cost,
            'power' => $this->power,
            'ability' => $this->ability,
            'flavor' => $this->flavor,
            'art' => $this->art,
            'alternative_art' => $this->alternative_art,
            'url' => $this->url,
            'status' => $this->status,
            'carddefid' => $this->carddefid,
            'source' => $this->source,
            'source_slug' => $this->source_slug,
            'rarity' => $this->rarity,
            'rarity_slug' => $this->rarity_slug,
            'difficulty' => $this->difficulty,
            'sketcher' => $this->sketcher,
            'inker' => $this->inker,
            'colorist' => $this->colorist,
            'variants' => VariantResource::collection($this->whenLoaded('variants')),
            'tags' => TagResource::collection($this->whenLoaded('tags'))
        ];
    }
}
