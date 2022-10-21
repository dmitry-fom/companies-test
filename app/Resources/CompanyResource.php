<?php

namespace App\Resources;

use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Company $this */

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'phone' => $this->phone,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
