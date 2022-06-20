<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Service;
use App\Orders\NewOrder;
use App\Orders\OrderManager;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    private OrderManager $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    public function store(OrderRequest $request)
    {
        $service = $request->input('service_id');

        $order = $this->orderManager->create(
            new NewOrder(
                Auth::user(),
                Service::find($service),
                $request->input('quantity')
            )
        );

        return new OrderResource($order);
    }

    public function cancel(Order $order): void
    {
        $this->orderManager->setOrder($order)->cancel();
    }
}
