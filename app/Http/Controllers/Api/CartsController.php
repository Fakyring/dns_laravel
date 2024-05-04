<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartsRequest;
use App\Http\Resources\CartsResource;
use App\Models\Carts;
use App\Models\Equipments;
use Illuminate\Http\Request;

class CartsController extends Controller {
    public function index() {
        if (!auth()->user() || auth()->user()->role == 0)
            return response()->json(['data' => "Недостаточно прав"], 403);
        return CartsResource::collection(Carts::all());
    }

    public function store(CartsRequest $cart) {
        if ($cart->count > Equipments::where("id_eq", $cart->id_eq)->first()->count)
            return response()->json(['data' => 'На складе нет такого количества товара'], 400);
        if (!auth()->user())
            return response()->json(['data' => 'Вы не авторизованы'], 403);
        $crt = Carts::create($cart->validated() + ["id_user" => auth()->user()->id_user]);
        $eq = Equipments::where("id_eq", $cart->id_eq)->first();
        $eq->update(['count' => $eq->count - $cart->count]);
        return $crt;
    }

    public function show($id) {
        $cart = Carts::where("id_cart", $id)->first();
        if (!$cart) {
            return response()->json(['data' => "Такой корзины нет"], 404);
        }
        return CartsResource::make($cart);
    }

    public function update(CartsRequest $request, Carts $cart) {
        if (!auth()->user() || (auth()->user()->role == 0 && auth()->user()->id_user != $cart->id_user))
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $eq = Equipments::where("id_eq", $cart->id_eq)->first();
        if ($request->count > $eq->count + $cart->count)
            return response()->json(['data' => 'На складе нет такого количества товара'], 400);
        if ($request->count != $cart->count)
            $eq->update(['count' => $eq->count + $cart->count - $request->count]);
        $cart->update($request->validated());
        return CartsResource::make($cart);
    }

    public function destroy(Request $request, Carts $cart) {
        if (!auth()->user() || (auth()->user()->role == 0 && auth()->user()->id_user != $cart->id_user))
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        if ($request->action == 0) {
            $eq = Equipments::where("id_eq", $cart->id_eq)->first();
            $eq->update(['count' => $eq->count + $cart->count]);
        }
        $cart->delete();
        return response()->noContent();
    }
}
