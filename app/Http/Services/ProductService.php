<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
  public function __construct(private Product $product) {}
}
