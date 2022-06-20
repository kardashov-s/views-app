<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Orders\OrderManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public OrderManager $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    public function index(Request $request)
    {
        $orders = Order::query()
            ->when((int)$request->input('id'), function (Builder $query, int $id) {
                return $query->where('id', $id);
            })
            ->when((array)$request->input('statuses'), function (Builder $query, array $statuses) {
                return $query->whereIn('status', $statuses);
            })
            ->when((string)$request->input('sort'), function (Builder $query, string $sort) {
                list($column, $direction) = explode(',', $sort);
                return $query->orderBy($column, $direction);
            })
            ->paginate(20);

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => Order::STATUSES,
        ]);
    }
}
