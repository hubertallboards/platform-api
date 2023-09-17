<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): ResourceCollection
    {
        return $this->orderRepository->index();
    }

    public function show(string $id): OrderResource
    {
        return $this->orderRepository->show($id);
    }
}
