<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        return ProductResource::collection($this->productService->allProducts());
    }
    public function show($id)
    {
        return new ProductResource($this->productService->detailsProduct($id));
    }

    public function filterByClient($client_id)
    {
        return ProductResource::collection($this->productService->productsByClient($client_id));
    }

    public function store(ProductStoreRequest $request)
    {
        return new ProductResource($this->productService->newProduct($request));
    }
    public function update(ProductUpdateRequest $request, $id)
    {
        return new ProductResource($this->productService->editProduct($request, $id));
    }
    public function delete($id)
    {
        return response()->json($this->productService->deleteProduct($id));
    }
}
