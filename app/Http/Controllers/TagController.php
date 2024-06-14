<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkStoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate();
        if ($tags->isEmpty()) {
            $data = [
                'message' => 'No hay tags registrados',
                'status' => 200,
            ];
            return response()->json($data, 200);
        }
        return response()->json($tags, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tag' => ['string', 'required', 'max:255', 'unique:tags'],
            'tag_slug' => ['string', 'required', 'max:255', 'unique:tags']
        ]);

        $tag = Tag::create([
            'tag' => $request->tag,
            'tag_slug' => $request->tag_slug
        ]);
        $data = [
            'message' => 'Tag Creado',
            'data' => $tag,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function bulkStore(BulkStoreTagRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,[]);
        });

        Tag::insert($bulk->toArray());
    }

    public function update(Request $request, Tag $tag)
    {
        $tag = Tag::find($tag->id);

        if(!$tag){
            $data = [
                'message' => 'Tag modificado',
                'data' => $tag,
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $validator = Validator::make($request->all(),[
            'tag' => ['string', 'required', 'max:255'],
            'tag_slug' => ['string', 'required', 'max:255']
        ]);

        if(!$validator){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tag->tag = $request->tag;
        $tag->tag_slug = $request->tag_slug;

        $tag->save();

        $data = [
            'message' => 'Tag Modificado',
            'errors' => $tag,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function updatePartial(Request $request, Tag $tag)
    {
        $tag = Tag::find($tag->id);
        if(!$tag){
            $data = [
                'message' => 'Tag no encontrado',
                'status' => 400
            ];
            return response()->json($data,400);
        }
        $validator = Validator::make($request->all(),[
            'tag' => ['string', 'max:255'],
            'tag_slug' => ['string', 'max:255']
        ]);

        if(!$validator){
            $data = [
                'message' => 'Error en la validación de los datos',
                'status' => 400
            ];
            return response()->json($data,400);
        }

        if ($request->has('tag')) {
            $tag->tag = $request->tag;
        }
        if ($request->has('tag_slug')) {
            $tag->tag_slug = $request->tag_slug;
        }
        $tag->save();

        $data = [
            'message' => 'Tag Actualizado',
            'character' => $tag,
            'status' => 200
        ];
        return response()->json($data, 200);

    }

    public function destroy(Tag $tag)
    {
        Tag::findOrFail($tag->id)->delete();

        $data = [
            'message' => 'Tag Eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }


}
