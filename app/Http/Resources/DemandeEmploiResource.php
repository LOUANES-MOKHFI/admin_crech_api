<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeEmploiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'user_id' => new UserResource($this->user),
            'offre_id' => new OffreEmploiResource($this->offre),
            'creche_id' => new CrecheResource($this->creche)
        ];
    }
}


