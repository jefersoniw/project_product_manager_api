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
}
