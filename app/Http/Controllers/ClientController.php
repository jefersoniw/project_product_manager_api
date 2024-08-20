<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Services\ClientService;
use App\Models\Client;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService) {}

    /**
     * @OA\GET(
     *     path="/api/clients",
     *     tags={"/Clients"},
     *     summary="All Clients",
     *     description="Show all clients.",
     *     security={ {"bearerToken":{}} },
     *  @OA\Response(
     *    response=200,
     *    description="Show all clients!",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Show all clients!")
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
        return ClientResource::collection($this->clientService->allClients());
    }

    /**
     * @OA\GET(
     *     path="/api/clients/{id}",
     *     tags={"/Clients"},
     *     summary="Show details client",
     *     description="Show details client.",
     *     security={ {"bearerToken":{}} },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id Client",
     *         required=true,
     *     ),  
     *     @OA\Response(
     *         response=200,
     *         description="Show details client!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Show details client!")
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
        return new ClientResource($this->clientService->detailsClient($id));
    }

    /**
     * @OA\POST(
     *  tags={"/Clients"},
     *  summary="Creating a new client.",
     *  description="Creating a new client.",
     *  path="/api/clients/",
     *  security={ {"bearerToken":{}} },
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *                 required={"name","cpf", "address", "photo", "sex"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="photo",
     *                     type="file"
     *                 ),
     *                 @OA\Property(
     *                     property="sex",
     *                     type="string"
     *                 ),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=201,
     *         description="Client created!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Client created!")
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
    public function store(ClientStoreRequest $request)
    {
        return new ClientResource($this->clientService->newClient($request));
    }

    /**
     * @OA\PUT(
     *  tags={"/Clients"},
     *  summary="Updating client.",
     *  description="Updating client.",
     *  path="/api/clients/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id client",
     *         required=true,
     *  ),
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                 required={"email","password"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="sex",
     *                     type="string"
     *                 ),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *         response=200,
     *         description="Client updated!",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Client updated!")
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
    public function update(ClientUpdateRequest $request, $id)
    {
        return new ClientResource($this->clientService->editClient($request, $id));
    }

    /**
     * @OA\DELETE(
     *  tags={"/Clients"},
     *  summary="Delete client!",
     *  description="Delete client!",
     *  path="/api/clients/delete/{id}",
     *  security={ {"bearerToken":{}} },
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id client",
     *         required=true,
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Client deleted!",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Client deleted!")
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
        return response()->json($this->clientService->deleteClient($id));
    }
}
