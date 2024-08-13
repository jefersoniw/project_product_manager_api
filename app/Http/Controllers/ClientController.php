<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService) {}

    public function index()
    {
        return ClientResource::collection($this->clientService->allClients());
    }

    public function show($id)
    {
        return new ClientResource($this->clientService->detailsClient($id));
    }

    public function store(ClientStoreRequest $request)
    {
        return new ClientResource($this->clientService->newClient($request));
    }

    public function update(ClientUpdateRequest $request, $id) {}

    public function delete(Client $client) {}
}
