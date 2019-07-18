<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Api\AuthRepository;
use App\Http\Requests\Api\Auth\Register\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;



class RegisterController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      operationId="register",
     *      tags={"Registration"},
     *      summary="Register a new User",
     *      description="Register a new User",
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
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="role_id",
     *                     type="integer"
     *                 ),
     *                 example={
     *                          "name": "User Full Name",
     *                          "email": "user@email.com",
     *                          "role_id":1,
     *                          "password": "secret",
     *                          "password_confirmation":"secret"
     *                          }
     *             )
     *         )
     *     ),
     *      @OA\Response(response=201,description="Created"),
     *      @OA\Response(response=422, description="Unprocessable Entity"),
     *       @OA\Response(response=500, description="Unable to process request"),
     *     )
     *
     * Register a new User
     */
    public function register(RegisterRequest $request)
    {
        try {
            return $this->authRepository->register($request->validated());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to process register request' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
