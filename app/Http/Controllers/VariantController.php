<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkStoreVariantRequest;
use App\Models\Character;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::paginate();

        if($variants->isEmpty()){
            $data = [
                "message" => 'No hay variantes registradas',
                "status" => 200
            ];
            return response()->json($data, 200);
        }
        return response()->json($variants,200);
    }

    public function store(Request $request)
    {
        //validar los datos a ingresar
        $request->validate([
            'character_id' => ['required', 'integer', 'exists:characters,id'],
            'art' => ['required', 'string', 'max:255'],
            'art_filename' => ['required', 'string', 'max:255'],
            'rarity' => ['required', 'string', 'max:255'],
            'rarity_slug' => ['required', 'string', 'max:255'],
            'variant_order' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'full_description' => ['string', 'max:255','nullable'],
            'inker' => ['nullable', 'string', 'max:255'],
            'sketcher' => ['required', 'string', 'max:255'],
            'colorist' => ['required', 'string', 'max:255'],
            'possession' => ['nullable', 'string', 'max:255'],
            'usage_count' => ['nullable', 'string', 'max:255'],
            'ReleaseDate' => ['numeric'],
            'UseIfOwn' => ['nullable', 'string', 'max:255'],
            'PossesionShare' => ['required', 'string', 'max:255'],
            'UsageShare' => ['required', 'string', 'max:255'],
        ]);
        $character = Character::findOrFail($request->character_id);
        //Crear los datos según el fillable
        $variant = $character->variants()->create([
            'character_id' => $request->character_id,
            'art'=> $request->art,
            'art_filename'=> $request->art_filename,
            'rarity' => $request->rarity,
            'rarity_slug' => $request->rarity_slug,
            'variant_order' => $request->variant_order,
            'status' => $request->status,
            'full_description' => $request->full_description,
            'inker' => $request->inker,
            'sketcher' => $request->sketcher,
            'colorist' => $request->colorist,
            'possession' => $request->possession,
            'usage_count' => $request->usage_count,
            'ReleaseDate' => $request->ReleaseDate,
            'UseIfOwn' => $request->UseIfOwn,
            'PossesionShare' => $request->PossesionShare,
            'UsageShare' => $request->UsageShare,
        ]);
        //retornar una respuesta
        return response()->json([
            "data" => $variant
        ], 200);
    }

    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'character_id' => ['required', 'integer', 'exists:characters,id'],
            'art' => ['required', 'string', 'max:255'],
            'art_filename' => ['required', 'string', 'max:255'],
            'rarity' => ['required', 'string', 'max:255'],
            'rarity_slug' => ['required', 'string', 'max:255'],
            'variant_order' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'full_description' => ['string', 'max:255', 'nullable'],
            'inker' => ['nullable', 'string', 'max:255'],
            'sketcher' => ['required', 'string', 'max:255'],
            'colorist' => ['required', 'string', 'max:255'],
            'possession' => ['nullable', 'string', 'max:255'],
            'usage_count' => ['nullable', 'string', 'max:255'],
            'ReleaseDate' => ['numeric'],
            'UseIfOwn' => ['nullable', 'string', 'max:255'],
            'PossesionShare' => ['required', 'string', 'max:255'],
            'UsageShare' => ['required', 'string', 'max:255'],
        ]);

        $character = Character::findOrFail($request->character_id);

        $character->variants()->where('id',$variant->id)->update([
            'character_id' => $request->character_id,
            'art' => $request->art,
            'art_filename' => $request->art_filename,
            'rarity' => $request->rarity,
            'rarity_slug' => $request->rarity_slug,
            'variant_order' => $request->variant_order,
            'status' => $request->status,
            'full_description' => $request->full_description,
            'inker' => $request->inker,
            'sketcher' => $request->sketcher,
            'colorist' => $request->colorist,
            'possession' => $request->possession,
            'usage_count' => $request->usage_count,
            'ReleaseDate' => $request->ReleaseDate,
            'UseIfOwn' => $request->UseIfOwn,
            'PossesionShare' => $request->PossesionShare,
            'UsageShare' => $request->UsageShare,
        ]);

        $data = [
            "message" => "Variante modificada",
            "data" => $variant,
            "status" => 200
        ];
        return response()->json($data,200);
    }

    public function destroy(Variant $variant)
    {
        Variant::findOrFail($variant->id)->delete();

        $data = [
            'message' => 'Variante Eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(Variant $variant)
    {
        $variant = Variant::findOrFail($variant->id);
        if (!$variant) {
            $data = [
                "message" => "Variante no encontrada",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            "message" => "Variante Encontrada!",
            "data" => $variant,
            "status" => 200
        ];
        return response()->json($data,200);
    }

    public function updatePartial(Request $request, Variant $variant)
    {
        $request->validate([
            'character_id' => ['sometimes', 'integer','exists:characters,id'],
            'art' => ['sometimes', 'string', 'max:255'],
            'art_filename' => ['sometimes', 'string', 'max:255'],
            'rarity' => ['sometimes', 'string', 'max:255'],
            'rarity_slug' => ['sometimes', 'string', 'max:255'],
            'variant_order' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', 'max:255'],
            'full_description' => ['string', 'max:255', 'nullable'],
            'inker' => ['nullable', 'string', 'max:255'],
            'sketcher' => ['sometimes', 'string', 'max:255'],
            'colorist' => ['sometimes', 'string', 'max:255'],
            'possession' => ['nullable', 'string', 'max:255'],
            'usage_count' => ['nullable', 'string', 'max:255'],
            'ReleaseDate' => ['numeric'],
            'UseIfOwn' => ['nullable', 'string', 'max:255'],
            'PossesionShare' => ['sometimes', 'string', 'max:255'],
            'UsageShare' => ['sometimes', 'string', 'max:255'],
        ]);

        $variant = Variant::find($variant->id);

        if ($request->has('character_id')) {
            $variant->character_id = $request->character_id;
        }
        if ($request->has('art')) {
            $variant->art = $request->art;
        }
        if ($request->has('art_filename')) {
            $variant->art_filename = $request->art_filename;
        }
        if ($request->has('rarity')) {
            $variant->rarity = $request->rarity;
        }
        if ($request->has('rarity_slug')) {
            $variant->rarity_slug = $request->rarity_slug;
        }
        if ($request->has('variant_order')) {
            $variant->variant_order = $request->variant_order;
        }
        if ($request->has('status')) {
            $variant->status = $request->status;
        }
        if ($request->has('full_description')) {
            $variant->full_description = $request->full_description;
        }
        if ($request->has('inker')) {
            $variant->inker = $request->inker;
        }
        if ($request->has('sketcher')) {
            $variant->sketcher = $request->sketcher;
        }
        if ($request->has('colorist')) {
            $variant->colorist = $request->colorist;
        }
        if ($request->has('possession')) {
            $variant->possession = $request->possession;
        }
        if ($request->has('usage_count')) {
            $variant->usage_count = $request->usage_count;
        }
        if ($request->has('ReleaseDate')) {
            $variant->ReleaseDate = $request->ReleaseDate;
        }
        if ($request->has('UseIfOwn')) {
            $variant->UseIfOwn = $request->UseIfOwn;
        }
        if ($request->has('PossesionShare')) {
            $variant->PossesionShare = $request->PossesionShare;
        }
        if ($request->has('ReleaseDate')) {
            $variant->UsageShare = $request->UsageShare;
        }

        $variant->save();

        $data = [
            "message" => "Variante modificada",
            "data" => $variant,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    public function bulkStore(BulkStoreVariantRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, []);
        });

        Variant::insert($bulk->toArray());
    }
}
