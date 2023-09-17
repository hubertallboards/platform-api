<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private ProductServiceInterface $productService;

    public function __construct(ProductRepositoryInterface $productRepository, ProductServiceInterface $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    public function index(): ResourceCollection
    {
        return $this->productRepository->index();
    }

    public function show(string $id): ProductResource
    {
        return $this->productRepository->show($id);
    }

    public function store(Request $request): Response
    {
        $this->authorize('edit', 'products');
        return $this->productService->store($request);
    }

    public function update(string $id, Request $request): Response
    {
        $this->authorize('edit', 'products');
        return $this->productService->update($id, $request);
    }

    public function destroy(string $id): Response
    {
        $this->authorize('edit', 'products');
        return $this->productService->destroy($id);
    }
}
