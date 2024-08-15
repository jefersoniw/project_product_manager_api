<?php

namespace App\Http\Services;

use App\Models\User;

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
}
