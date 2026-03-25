<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'car' => new CarResource($this->whenLoaded('car')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'sale_price' => (float) $this->sale_price,
            'sale_date' => $this->sale_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
