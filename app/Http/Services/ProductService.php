<?php

namespace App\Http\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Client;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductService
{
  public function __construct(
    private Product $product,
    private Client $client
  ) {}

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

  public function newProduct(ProductStoreRequest $request)
  {
    try {
      $base64 = base64_encode(file_get_contents($request->photo->path()));
      $mime = 'data:' . 'image/' . $request->photo->extension() . ';base64,';
      $photo = $mime . $base64;

      $client = $this->client->find($request->client_id);
      if (!$client) {
        throw new Exception("Client not exists!");
      }

      $product = $this->product->create([
        'name' => $request->name,
        'price' => $request->price,
        'client_id' => $client->id,
        'photo' => $photo,
      ]);

      if (!$product) {
        throw new Exception("Error create new product!");
      }

      return $product;
    } catch (Exception $error) {

      Log::warning('Error create new product', [
        'error' => $error->getMessage()
      ]);

      return [
        'error' => true,
        'msg' => $error->getMessage(),
      ];
    }
  }
}
