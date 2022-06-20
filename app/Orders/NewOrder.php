<?php

namespace App\Orders;

use App\Models\Service;
use App\Models\User;

class NewOrder
{
    public User $user;
    public Service $service;
    public int $quantity;

    public function __construct(
        User $user,
        Service $service,
        int $quantity
    ) {
        $this->user = $user;
        $this->service = $service;
        $this->quantity = $quantity;
    }
}
