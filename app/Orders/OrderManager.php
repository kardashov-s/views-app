<?php

namespace App\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Money\Money;

class OrderManager
{

    private ?Order $order;

    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function create(NewOrder $newOrder): Order
    {
        DB::transaction(function () use ($newOrder) {
            $this->order = new Order();
            $this->order->quantity = $newOrder->quantity;
            $this->order->price = $newOrder->service->price;
            $this->order->max_provider_price = $newOrder->service->max_provider_price;
            $this->order->service()->associate($newOrder->service);
            $this->order->user()->associate($newOrder->user);

            $this->order->saveOrFail();
        });

        return $this->order;
    }

    public function cost(): Money
    {
        return $this->order->price->multiply($this->order->quantity / Order::DEFAULT_PRICING_PER);
    }
}
