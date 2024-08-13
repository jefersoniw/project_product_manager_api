<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index() {}
    public function show($id) {}
    public function store(Request $request) {}
    public function update(Request $request, $id) {}
    public function delete($id) {}
}
