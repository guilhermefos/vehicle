<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Api\AuthRepository;
use App\Http\Requests\Api\Auth\Login\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository =  $authRepository;
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"login"},
     *      operationId="login",
     *      tags={"Authentication"},
     *      summary="Log the user in and returns the access token",
     *      description="Log the user in and returns the access token",
     *     @OA\Parameter(
     *         name="X-Requested-With",
     *         in="header",
     *         description="Type XMLHttpRequest as value to this field",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(
     *      required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "user@email.com", "password": "secret"}
     *             )
     *         )
     *     ),
     *
     *      @OA\Response(response=200, description="Ok"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *      @OA\Response(response=500, description="Internal Server Error"),
     *     )
     *
     * Log the user in
     */
    public function login(LoginRequest $request)
    {
        try {
            return $this->authRepository->login(request(['email', 'password']), $request);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Unable to process login request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *      path="/auth/logout",
     *      operationId="logout",
     *      tags={"Authentication"},
     *      summary="Log the user out",
     *      description="Log the user out",
     *     @OA\Parameter(
     *         name="X-Requested-With",
     *         in="header",
     *         description="Type XMLHttpRequest as value to this field",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *
     *         ),
     *         style="form"
     *     ),
     *      @OA\Response(response=204,description="No Content"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *      @OA\Response(response=405,description="Method Not Allowed"),
     *       @OA\Response(response=500, description="Unable to process request"),
     *     security={{"api_key":{}}}
     *     )
     *
     *
     * Log the user out
     */
    public function logout()
    {
        try {
            return $this->authRepository->logout();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to process logout request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
