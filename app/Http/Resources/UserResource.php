<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_user,
            'email' => $this->email,
            'name' => $this->name,
            'id_role' => $this->role,
            'role' => $this->role == 0 ? "User" : "Admin",
            'status' => $this->status == 0 ? "Disabled" : "Active"
        ];
    }
}
