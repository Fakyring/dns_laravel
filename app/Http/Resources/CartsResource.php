<?php

namespace App\Http\Resources;

use App\Models\Equipments;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_cart,
            'id_user' => $this->id_user,
            'user' => Users::where('id_user', $this->id_user)->first()->name,
            'id_eq' => $this->id_eq,
            'eq' => Equipments::where('id_eq', $this->id_eq)->first()->name,
            'Count' => $this->count
        ];
    }
}
