<?php

namespace App\Services;

use App\Events\BookingApproved;
use App\Models\Order;
use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;

/** Here we are going just ignore repository layer due to pathetic app */
class OrderService
{
    /**
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        return Order::with(['carSize'])->get();
    }

    /**
     * @return Collection
     */
    public function getCarSizes(): Collection
    {
        return Size::query()->select(['id', 'name'])->get();
    }

    /**
     * @param Order $order
     * @return void
     */
    public function approveOrder(Order $order): void
    {
        $order->approve();
        BookingApproved::dispatch($order);
    }
}
