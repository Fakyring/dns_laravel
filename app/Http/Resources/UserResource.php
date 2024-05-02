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
            'ID' => $this->id_user,
            'Email' => $this->email,
            'Name' => $this->name,
            'Role' => $this->role == 0 ? "User" : "Admin",
            'Status' => $this->status == 0 ? "Disabled" : "Active"
        ];
    }
}
