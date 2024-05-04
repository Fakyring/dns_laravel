<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentsRequest;
use App\Http\Resources\EquipmentsResource;
use App\Models\Equipments;
use Illuminate\Support\Facades\Storage;

class EquipmentsController extends Controller {
    public function index() {
        return EquipmentsResource::collection(Equipments::all());
    }

    public function store(EquipmentsRequest $equipment) {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(['data' => "Недостаточно прав"], 403);
        $imageName = $equipment->image->store('public');
        $eq = Equipments::create($equipment->validated() + ["image" => asset(Storage::url($imageName))]);
        return $eq;
    }

    public function show($id) {
        $equipment = Equipments::where("id_eq", $id)->first();
        if (!$equipment) {
            return response()->json(['data' => "Такого оборудования нет"], 404);
        }
        return EquipmentsResource::make($equipment);
    }

    public function update(EquipmentsRequest $request, Equipments $equipment) {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $equipment->update($request->validated());
        return EquipmentsResource::make($equipment);
    }

    public function destroy(Equipments $equipment) {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $equipment->delete();
        return response()->noContent();
    }
}
