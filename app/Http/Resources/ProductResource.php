<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
          'code' => $this->code,
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_price' => $this->product_price,
            'product_quantity' => $this->product_quantity,
            'status' => $this->status,
            'product_size' => $this->product_size,
            'product_brand' => $this->product_brand,
            'media' => new ProductMediaResource($this->whenLoaded('media')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'date' => $this->date,
        ];
    }
}
