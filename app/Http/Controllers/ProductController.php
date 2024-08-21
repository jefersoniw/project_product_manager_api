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

    /**
     * @OA\GET(
     *     path="/api/products",
     *     tags={"/Products"},
     *     summary="All Products",
     *     description="Show all products.",
     *     security={ {"bearerToken":{}} },
     *  @OA\Response(
     *    response=200,
     *    description="Show all products!",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Show all products!")
     *    )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     * )
     */
    public function index()
    {
        return ProductResource::collection($this->productService->allProducts());
    }

    /**
     * @OA\GET(
     *     path="/api/products/{id}",
     *     tags={"/Products"},
     *     summary="Show details product",
     *     description="Show details product.",
     *     security={ {"bearerToken":{}} },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id Product",
     *         required=true,
     *     ),  
     *     @OA\Response(
     *         response=200,
     *         description="Show details product!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Show details product!")
     *     )
     *  ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     * )
     */
    public function show($id)
    {
        return new ProductResource($this->productService->detailsProduct($id));
    }

    /**
     * @OA\GET(
     *     path="/api/products/client/{client_id}",
     *     tags={"/Products"},
     *     summary="Show product by client.",
     *     description="Show product by client.",
     *     security={ {"bearerToken":{}} },
     *     @OA\Parameter(
     *         name="client_id",
     *         in="path",
     *         description="Id client",
     *         required=true,
     *     ),  
     *     @OA\Response(
     *         response=200,
     *         description="Show products by client!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Show product by client!")
     *     )
     *  ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     * )
     */
    public function filterByClient($client_id)
    {
        return ProductResource::collection($this->productService->productsByClient($client_id));
    }

    /**
     * @OA\POST(
     *  tags={"/Products"},
     *  summary="Creating a new product.",
     *  description="Creating a new product.",
     *  path="/api/products/",
     *  security={ {"bearerToken":{}} },
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *                 required={"name","price", "client_id", "photo"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="client_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="photo",
     *                     type="file"
     *                 ),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=201,
     *         description="Product created!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Product created!")
     *     )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Incorrect fields",
     *      @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Incorrect fields"),
     *         @OA\Property(property="errors", type="string", example="..."),
     *      )
     *   )
     * )
     */
    public function store(ProductStoreRequest $request)
    {
        return new ProductResource($this->productService->newProduct($request));
    }

    /**
     * @OA\PUT(
     *  tags={"/Products"},
     *  summary="Updating product.",
     *  description="Updating product.",
     *  path="/api/products/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id product",
     *         required=true,
     *  ),
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="client_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="photo",
     *                     type="file"
     *                 ),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=200,
     *         description="Product updated!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Product updated!")
     *     )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Incorrect fields",
     *      @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Incorrect fields"),
     *         @OA\Property(property="errors", type="string", example="..."),
     *      )
     *   )
     * )
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        return new ProductResource($this->productService->editProduct($request, $id));
    }

    /**
     * @OA\DELETE(
     *  tags={"/Products"},
     *  summary="Delete product!",
     *  description="Delete product!",
     *  path="/api/products/delete/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id product",
     *         required=true,
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Product deleted!",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Product deleted!")
     *    )
     *  ),
     *  @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    )
     *  )
     * )
     */
    public function delete($id)
    {
        return response()->json($this->productService->deleteProduct($id));
    }
}
