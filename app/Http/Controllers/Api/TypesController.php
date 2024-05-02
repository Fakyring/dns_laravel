<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypesRequest;
use App\Http\Resources\TypesResource;
use App\Models\Types;

class TypesController extends Controller
{
    public function index()
    {
        return TypesResource::collection(Types::all());
    }

    public function store(TypesRequest $type)
    {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        if (Types::where('name', $type['name'])->first()) {
            return response()->json(['data' => "Категория уже существует"], 409);
        }
        $typ = Types::create($type->validated());
        return $typ;
    }

    public function show($id)
    {
        $type = Types::where("id_type", $id)->first();
        if (!$type) {
            return response()->json(['data' => "Такой категории нет"], 404);
        }
        return TypesResource::make($type);
    }

    public function destroy(Types $type)
    {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $type->delete();
        return response()->noContent();
    }
}
