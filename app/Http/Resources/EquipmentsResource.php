<?php

namespace App\Http\Resources;

use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EquipmentsResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id_eq,
            'name' => $this->name,
            'id_type' => $this->type,
            'type' => Types::where('id_type', $this->type)->first()->name,
            'descr' => strlen($this->descr) == 0 ? "Описания нет" : $this->descr,
            'count' => $this->count,
            'price' => $this->price,
            'image' => Storage::url($this->image)
        ];
    }
}
