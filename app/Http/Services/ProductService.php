<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
  public function __construct(private Product $product) {}

  public function allProducts()
  {
    return $this
      ->product
      ->select('id', 'name', 'price', 'client_id')
      ->with('client', function ($query) {
        $query->select('id', 'name', 'cpf', 'address', 'sex');
      })
      ->paginate(10);
  }

  public function detailsProduct($id)
  {
    $product = $this
      ->product
      ->with('client')
      ->find($id);

    if (!$product) {
      return [
        'error' => true,
        'msg' => 'Product not exists!'
      ];
    }

    return $product;
  }

  public function productsByClient($client_id)
  {
    return $this
      ->product
      ->select('id', 'name', 'price', 'client_id')
      ->with('client', function ($query) {
        $query->select('id', 'name', 'cpf', 'address', 'sex');
      })
      ->where('client_id', $client_id)
      ->paginate(10);
  }
}
