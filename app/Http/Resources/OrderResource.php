<?php

namespace App\Http\Resources;

use App\Orders\OrderManager;

class OrderResource extends Resource
{
    public function toArray($request)
    {
        $orderManager = app()->make(OrderManager::class)->setOrder($this->resource);

        return [
            'id' => $this->resource->id,
            'quantity' => $this->resource->quantity,
            'price' => $this->formatDecimalMoney($this->resource->price),
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at,
        ];
    }
}
