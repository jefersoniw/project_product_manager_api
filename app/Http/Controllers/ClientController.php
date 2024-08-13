<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use App\Http\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService) {}

    public function index()
    {
        $clients = $this->clientService->allClients();

        return ClientResource::collection($clients);
    }

    public function show($id)
    {
        $client = $this->clientService->detailClient($id);

        return new ClientResource($client);
    }

    public function store(ClientStoreRequest $request) {}

    public function update(Client $client, Request $request) {}

    public function delete(Client $client) {}
}
