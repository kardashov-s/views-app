<?php

namespace App\Http\Resources;

class ServiceResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
            'price' => $this->formatDecimalMoney($this->resource['price']),
            'min_quantity' => $this->resource['min_quantity'],
            'max_quantity' => $this->resource['max_quantity'],
        ];
    }
}
