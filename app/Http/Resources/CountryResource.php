<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $cityResource = new CityResource($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'cities' => [
                'name' => $cityResource->collection($this->whenLoaded('cities'))->pluck('name')
            ],
        ];
    }
}
