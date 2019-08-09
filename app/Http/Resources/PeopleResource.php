<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Sport;

class PeopleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nickname' => $this->nickname,
            'birth_date' => $this->birth_date,
            'country' => $this->whenLoaded('country', function () {
                return $this->country->name;
            }),
            'sport' => $this->whenLoaded('sport', function () {
                return $this->sport->name;
            })
        ];
    }
}
