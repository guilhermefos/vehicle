<?php

namespace App\Contracts\Api\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Auth\Login\LoginRequest;

trait LoginAuthorization
{
  protected function isAuthorized(Array $credentials)
  {
    return Auth::attempt($credentials);
  }

  protected function unauthorized()
  {
    return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
  }

  protected function authorized(LoginRequest $request)
  {
    $result = $request->user()->createToken($request->user()->name . ' Personal Access Token', ['self']);
    $token = $result->token;
    $token->save();

    return $this->authorizedMessage($result, $token);
  }

  protected function authorizedMessage($result, $token)
  {
    return response()->json(
      [
          'accessToken' => $result->accessToken,
          'token_type' => 'Bearer',
          'expires_at' => Carbon::parse($token->expires_at)->toDateString(),
          'scopes' => $token->scopes
      ], Response::HTTP_OK);
  }
}