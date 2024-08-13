<?php

namespace App\Http\Services;

use App\Models\Client;

class ClientService
{
  public function __construct(private Client $client) {}

  public function allClients()
  {
    return $this->client->paginate();
  }

  public function detailClient($id)
  {

    $client = $this->client->find($id);

    if (!$client) {
      return ['msg' => 'Client not exists!'];
    }

    return $client;
  }
}
