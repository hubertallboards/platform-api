<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ProductRepositoryInterface
{
    public function index(): ResourceCollection;
    public function show(string $id): ?ProductResource;
}
