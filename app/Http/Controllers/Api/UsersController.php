<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;

class UsersController extends Controller {
    public function index() {
        if (auth()->user() && auth()->user()->role === 1)
            return UserResource::collection(Users::all());
        else
            return response()->json(["data" => "У вас недостаточно прав"], 403);
    }

    public function show($id) {
        $user = Users::where("id_user", $id)->first();
        if (!$user) {
            return response()->json(['data' => "Такого пользователя нет"], 404);
        }
        return UserResource::make($user);
    }

    public function store(UserRequest $user) {
        if (Users::where('email', $user['email'])->first()) {
            return response()->json(['data' => "Пользователь уже существует"], 409);
        }
        $usr = Users::create($user->validated());
        return $usr;
    }

    public function update(UserRequest $request, Users $user) {
        if (!auth()->user() || auth()->user()->id_user !== $user->id_user)
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $user->update($request->validated());
        return UserResource::make($user);
    }

    public function destroy(Users $user) {
        if (!auth()->user() || (auth()->user()->id_user !== $user->id_user && auth()->user()->role != 1))
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $user->delete();
        return response()->noContent();
    }
}
