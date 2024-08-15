<?php

namespace App\Http\Services;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService
{
  public function __construct(private User $user) {}
  public function allUsers()
  {
    return $this->user->paginate(10);
  }

  public function detailsUser($id)
  {
    $user = $this->user->find($id);

    if (!$user) {
      return [
        'error' => true,
        'msg' => 'Client not exists!'
      ];
    }

    return $user;
  }

  public function registerUser(UserStoreRequest $request)
  {
    try {

      $user = $this->user->create($request->all());

      if (!$user) {
        throw new Exception("Error create new client!");
      }

      return $user;
    } catch (Exception $error) {
      Log::warning('Error register user', [
        'error' => $error->getMessage()
      ]);

      return [
        'error' => true,
        'msg' => $error->getMessage(),
      ];
    }
  }
}
