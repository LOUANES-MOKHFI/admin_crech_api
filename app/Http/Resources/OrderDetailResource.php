<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductOrderResource;
use App\Http\Resources\VendorResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'order_id'  => $this->order_id,
            'product'  => new ProductOrderResource($this->product),
            'vendor'  => new VendorResource($this->vendor),
            'qty'  => $this->qty,
            'price'  => $this->price,
        ];
    }
}
