<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkStoreCharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Models\Tag;
use App\Models\Variant;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;


class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $characters = Character::paginate();
        $includeVariants = $request->query('includeVariants');
        if($includeVariants){
            $characters = $characters->with('variants');
        }
        $includeTags = $request->query('includeTags');
        if ($includeTags) {
            $characters = $characters->with('tags');
        }
        if($characters->isEmpty()){
            $data = [
                'message' => 'No hay personajes registrados',
                'status' => 200,
            ];
            return response()->json($data,200);
        }
        return response()->json($characters,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string', 'max:255', 'unique:characters'],
            'type' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'numeric'],
            'power' => ['required', 'numeric'],
            'ability' => ['string','max:255','nullable'],
            'flavor' => ['string','max:255'],
            'art' => ['required','string', 'max:255'],
            'alternative_art' => ['string', 'max:255','nullable'],
            'url' => ['required','string', 'max:255'],
            'status' => ['required','string', 'max:255'],
            'carddefid' => ['required','string', 'max:255'],
            'source' => ['required','string', 'max:255'],
            'source_slug' => ['required','string', 'max:255'],
            'rarity' => ['string','max:255','nullable'],
            'rarity_slug' => ['string','max:255','nullable'],
            'difficulty' => ['string','max:255','nullable'],
            'sketcher' => ['required','string','max:255'],
            'inker' => ['string','max:255','nullable'],
            'colorist' => ['required','string', 'max:255'],
        ]);
        $character = Character::create([
            'name'=> $request->name,
            'type'=> $request->type,
            'cost'=> $request->cost,
            'power'=> $request->power,
            'ability'=> $request->ability,
            'flavor'=> $request->flavor,
            'art'=> $request->art,
            'alternative_art'=> $request->alternative_art,
            'url'=> $request->url,
            'status'=> $request->status,
            'carddefid'=> $request->carddefid,
            'source'=> $request->source,
            'source_slug'=> $request->source_slug,
            'rarity'=> $request->rarity,
            'rarity_slug'=> $request->rarity_slug,
            'difficulty'=> $request->difficulty,
            'sketcher'=> $request->sketcher,
            'inker'=> $request->inker,
            'colorist'=> $request->colorist,
        ]);
        return response()->json([
            "data" => $character
        ],200);
    }

    public function show(Character $character)
    {
        $includeVariants = request()->query('includeVariants');
        $includeTags = request()->query('includeTags');
        if ($includeVariants or $includeTags) {
            return new CharacterResource($character->loadMissing(['variants','tags']));
        }
        //return new CharacterResource($character); método pro
        return $character->load('variants')->load('tags'); //metodo faster
    }
    public function update(Request $request, Character $character)
    {
        $character =  Character::find($character->id);
        if(!$character){
            $data = [
                'message' => 'Personaje no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'numeric'],
            'power' => ['required', 'numeric'],
            'ability' => ['string', 'max:255', 'nullable'],
            'flavor' => ['string', 'max:255'],
            'art' => ['required', 'string', 'max:255'],
            'alternative_art' => ['string', 'max:255', 'nullable'],
            'url' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'carddefid' => ['required', 'string', 'max:255'],
            'source' => ['required', 'string', 'max:255'],
            'source_slug' => ['required', 'string', 'max:255'],
            'rarity' => ['string', 'max:255', 'nullable'],
            'rarity_slug' => ['string', 'max:255', 'nullable'],
            'difficulty' => ['string', 'max:255', 'nullable'],
            'sketcher' => ['required', 'string', 'max:255'],
            'inker' => ['string', 'max:255', 'nullable'],
            'colorist' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $character->name = $request->name;
        $character->type = $request->type;
        $character->cost = $request->cost;
        $character->power = $request->power;
        $character->ability = $request->ability;
        $character->flavor = $request->flavor;
        $character->art = $request->art;
        $character->alternative_art = $request->alternative_art;
        $character->url = $request->url;
        $character->status = $request->status;
        $character->carddefid = $request->carddefid;
        $character->source = $request->source;
        $character->source_slug = $request->source_slug;
        $character->rarity = $request->rarity;
        $character->rarity_slug = $request->rarity_slug;
        $character->difficulty = $request->difficulty;
        $character->sketcher = $request->sketcher;
        $character->inker = $request->inker;
        $character->colorist = $request->colorist;

        $character->save();

        $data = [
            'message' => 'Personaje Actualizado',
            'data' => $character,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    public function updatePartial(Request $request, Character $character)
    {
        $character =  Character::find($character->id);
        if (!$character) {
            $data = [
                'message' => 'Personaje no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:255'],
            'cost' => ['sometimes', 'numeric'],
            'power' => ['sometimes', 'numeric'],
            'ability' => ['string', 'max:255', 'nullable'],
            'flavor' => ['string', 'max:255'],
            'art' => ['sometimes', 'string', 'max:255'],
            'alternative_art' => ['string', 'max:255', 'nullable'],
            'url' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', 'max:255'],
            'carddefid' => ['sometimes', 'string', 'max:255'],
            'source' => ['sometimes', 'string', 'max:255'],
            'source_slug' => ['sometimes', 'string', 'max:255'],
            'rarity' => ['string', 'max:255', 'nullable'],
            'rarity_slug' => ['string', 'max:255', 'nullable'],
            'difficulty' => ['string', 'max:255', 'nullable'],
            'sketcher' => ['sometimes', 'string', 'max:255'],
            'inker' => ['string', 'max:255', 'nullable'],
            'colorist' => ['sometimes', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('name')) {
            $character->name = $request->name;
        }
        if ($request->has('type')) {
            $character->type = $request->type;
        }
        if ($request->has('cost')) {
            $character->cost = $request->cost;
        }
        if ($request->has('power')) {
            $character->power = $request->power;
        }
        if ($request->has('ability')) {
            $character->ability = $request->ability;
        }
        if($request->has('flavor')) {
            $character->flavor = $request->flavor;
        }
        if ($request->has('art')) {
            $character->art = $request->art;
        }
        if ($request->has('alternative_art')) {
            $character->alternative_art = $request->alternative_art;
        }
        if ($request->has('url')) {
            $character->url = $request->url;
        }
        if ($request->has('status')) {
            $character->status = $request->status;
        }
        if ($request->has('carddefid')) {
            $character->carddefid = $request->carddefid;
        }
        if ($request->has('source')) {
            $character->source = $request->source;
        }
        if($request->has('source_slug')) {
            $character->source_slug = $request->source_slug;
        }
        if($request->has('rarity')) {
            $character->rarity = $request->rarity;
        }
        if($request->has('rarity_slug')) {
            $character->rarity_slug = $request->rarity_slug;
        }
        if ($request->has('difficulty')) {
            $character->difficulty = $request->difficulty;
        }
        if($request->has('sketcher')) {
            $character->sketcher = $request->sketcher;
        }
        if($request->has('inker')) {
            $character->inker = $request->inker;
        }
        if ($request->has('colorist')) {
            $character->colorist = $request->colorist;
        }

        $character->save();

        $data = [
            'message' => 'Personaje Actualizado',
            'data' => $character,
            'status' => 200
        ];
        return response()->json($data, 200);


    }
    public function destroy(Character $character)
    {
        Character::findOrFail($character->id)->delete();
        $data = [
            'message' => 'Personaje Eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function bulkStore(BulkStoreCharacterRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr,$key) {
            return Arr::except($arr,[]);
        });

        Character::insert($bulk->toArray());
    }

    // GESTIÓN DE TAGS Y CHARACTER
    public function addTags(Request $request, Character $character)
    {
        $character->tags()->syncWithoutDetaching($request->tags);

        return 'Attached';
    }
    public function deleteTags(Request $request, Character $character)
    {
        $character->tags()->detach($request->tags);

        return 'Detattached';
    }
    
    public function showTags()
    {
        $character = Character::all()->load('tags');
        return response()->json($character,200);
    }
}
