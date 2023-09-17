<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderRepository implements OrderRepositoryInterface
{
    private Order $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function index(): ResourceCollection
    {
        return OrderResource::collection($this->orderModel::with(['user', 'orderItems.product'])->paginate(10));
    }

    public function show(string $id): OrderResource
    {
        return new OrderResource($this->orderModel::with(['user', 'orderItems.product'])->find($id));
    }
}
