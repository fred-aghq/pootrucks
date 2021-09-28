<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => new ProductTypeResource($this->productType),
            'location' => [
                'id' => $this->location->id,
                'name' => $this->location->name,
            ],
            'amount' => $this->amount,
        ];
    }
}
