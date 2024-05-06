<?php

namespace App\Http\Resources;

use App\Models\Equipments;
use App\Models\Types;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $eq = Equipments::where("id_eq", $this->id_eq)->first();
        return [
            'id' => $this->id_cart,
            'user' => Users::where('id_user', $this->id_user)->first()->name,
            'id_eq' => $this->id_eq,
            'name' => Equipments::where('id_eq', $this->id_eq)->first()->name,
            'count' => $this->count,
            'type' => Types::where('id_type', $eq->type)->first()->name,
            'price' => $eq->price,
            'image' => Storage::url($eq->image),
            'descr' => strlen($eq->descr) == 0 ? "Описания нет" : $eq->descr
        ];
    }
}
