<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
  public function __construct(private Product $product) {}

  public function allProducts()
  {
    $products = $this
      ->product
      ->select('id', 'name', 'price', 'client_id')
      ->with('client', function ($query) {
        $query->select('id', 'name', 'cpf', 'address', 'sex');
      })
      ->paginate(10);

    return $products;
  }
}
