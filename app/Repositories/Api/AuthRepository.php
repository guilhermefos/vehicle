<?php

namespace App\Repositories\Api;

use App\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\Api\Auth\LoginAuthorization;
use App\Http\Requests\Api\Auth\Login\LoginRequest;

class AuthRepository
{
  use LoginAuthorization;

  public function login(Array $credentials, LoginRequest $request)
  {
    return $this->isAuthorized($credentials) ? $this->authorized($request) : $this->unauthorized();
  }

  public function logout()
  {
      Auth::user()->token()->revoke();
      return response()->json([], Response::HTTP_NO_CONTENT);
  }

  public function register($data)
  {
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'role_id' => $data['role_id'],
    ]);

    return response()->json($user, Response::HTTP_CREATED);
  }
}