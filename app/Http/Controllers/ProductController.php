<?php

namespace App\Http\Controllers;

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
    public function show($id) {}
    public function store(Request $request) {}
    public function update(Request $request, $id) {}
    public function delete($id) {}
}
