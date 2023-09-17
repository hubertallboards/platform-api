<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function index(): ResourceCollection
    {
        return ProductResource::collection($this->productModel::with('category')->paginate(10));
    }

    public function show(string $id): ProductResource
    {
        return new ProductResource($this->productModel::with('category')->find($id));
    }
}
