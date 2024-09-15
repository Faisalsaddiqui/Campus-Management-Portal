<?php

namespace App\Services\Admin;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{

  public function createUser(array $data): User
  {
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    return $user;
  }
}
