<?php

namespace App\Http\Services;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientService
{
  public function __construct(private Client $client) {}

  public function allClients()
  {
    return $this
      ->client
      ->select('id', 'name', 'cpf', 'address', 'sex')
      ->paginate();
  }

  public function detailsClient($id)
  {

    $client = $this->client->find($id);

    if (!$client) {
      return [
        'error' => true,
        'msg' => 'Client not exists!'
      ];
    }

    return $client;
  }

  public function newClient(ClientStoreRequest $request)
  {
    try {

      if (!validateCpf($request->cpf)) {
        throw new Exception("CPF is invalid!");
      }

      $base64 = base64_encode(file_get_contents($request->photo->path()));
      $mime = 'data:' . 'image/' . $request->photo->extension() . ';base64,';
      $photo = $mime . $base64;

      $client = $this->client->create([
        'name' => $request->name,
        'cpf' => $request->cpf,
        'address' => $request->address,
        'photo' => $photo,
        'sex' => $request->sex
      ]);

      if (!$client) {
        throw new Exception("Error create new client!");
      }

      return $client;
    } catch (Exception $error) {

      Log::warning('Error create new client', [
        'error' => $error->getMessage()
      ]);

      return [
        'error' => true,
        'msg' => $error->getMessage(),
      ];
    }
  }

  public function editClient(ClientUpdateRequest $request, $id)
  {
    try {

      if (!!$request->cpf) {
        if (!validateCpf($request->cpf)) {
          throw new Exception("CPF is invalid!");
        }
      }

      $client = $this->client->find($id);
      if (!$client) {
        throw new Exception("Client not exists!");
      }

      $client->update($request->all());

      if (!$client) {
        throw new Exception("Error update client!");
      }

      return $client;
    } catch (Exception $error) {

      Log::warning('Error update client', [
        'error' => $error->getMessage()
      ]);

      return [
        'error' => true,
        'msg' => $error->getMessage(),
      ];
    }
  }

  public function deleteClient($id)
  {
    $client = $this->client->find($id);

    if (!$client) {
      return [
        'msg' => 'Client not exists!'
      ];
    }

    $client->delete();

    return [
      'msg' => 'Client deleted!'
    ];
  }
}
