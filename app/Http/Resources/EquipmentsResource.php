<?php

namespace App\Http\Resources;

use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID' => $this->id_eq,
            'Name' => $this->name,
            'Type' => Types::where('id_type', $this->type)->first()->name,
            'Description' => strlen($this->descr) == 0 ? "Описания нет" : $this->descr,
            'Count' => $this->count,
            'Price' => $this->price
        ];
    }
}
