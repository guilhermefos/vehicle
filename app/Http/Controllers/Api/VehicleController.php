<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\VehicleRepository;
use App\Http\Requests\Api\VehicleRequest;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @OA\Get(
     *      path="/vehicle",
     *      operationId="vehicle",
     *      tags={"Vehicle"},
     *      summary="List all vehicles from a user",
     *      description="List all vehicles from a user",
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
     *      @OA\Response(response=200,description="Ok"),
     *      @OA\Response(response=500, description="Unable to process list request"),
     *     security={{"api_key":{}}}
     *     )
     *
     *
     * List all vehicles
     */
    public function index()
    {
        try {
            return $this->vehicleRepository->index();
        }catch(\Exception $e) {
            return response()->json(['message' => 'Unable to process list request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *      path="/vehicle/store",
     *      operationId="vehicle",
     *      tags={"Vehicle"},
     *      summary="Register a new Vehicle",
     *      description="Register a new Vehicle",
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
     *                     property="brand",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="chassis",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="color",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="model",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="year",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="plate",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="renavam",
     *                     type="string"
     *                 ),
     *                 example={
     *                          "brand": "Fiat",
     *                          "chassis": "9BUSU19F08B302158",
     *                          "color": "Vermelho",
     *                          "model": "Tempra 8V/ City 8V",
     *                          "year": "2019-07-17 22:35:00",
     *                          "plate": "HAC-0866",
     *                          "renavam": "49312760291"
     *                          }
     *             )
     *         )
     *     ),
     *      @OA\Response(response=201, description="Created"),
     *      @OA\Response(response=500, description="Unable to process create request"),
     *      security={{"api_key":{}}}
     *     )
     *
     * Register a new Vehicle
     */
    public function store(VehicleRequest $request)
    {
        try {
            return $this->vehicleRepository->store($request->validated());
        }catch(\Exception $e) {
            return response()->json(['message' => 'Unable to process create request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\put(
     *      path="/vehicle/update",
     *      operationId="vehicle",
     *      tags={"Vehicle"},
     *      summary="Update a storage Vehicle",
     *      description="Update a storage Vehicle",
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
     *                     property="brand",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="chassis",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="color",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="model",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="year",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="plate",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="renavam",
     *                     type="string"
     *                 ),
     *                 example={
     *                          "brand": "Palio",
     *                          "chassis": "9BUSU19F08B302158",
     *                          "color": "Vermelho",
     *                          "model": "Tempra 8V/ City 8V",
     *                          "year": "2019-07-17 22:35:00",
     *                          "plate": "HAC-0866",
     *                          "renavam": "49312760291"
     *                          }
     *             )
     *         )
     *     ),
     *      @OA\Response(response=200, description="Updated"),
     *      @OA\Response(response=500, description="Unable to process update request"),
     *      security={{"api_key":{}}}
     *     )
     *
     * Update a storage Vehicle
     */
    public function update(VehicleRequest $request)
    {
        try {
            return $this->vehicleRepository->update($request->validated());
        }catch(\Exception $e) {
            return response()->json(['message' => 'Unable to process update request'.$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *      path="/vehicle/destroy/{id}",
     *      operationId="vehicle",
     *      tags={"Vehicle"},
     *      summary="Delete a Vehicle",
     *      description="Delete a Vehicle",
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
     * 
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the vehicle that needs to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *       )
     *     ),
     * 
     *      @OA\Response(response=200, description="Deleted"),
     *      @OA\Response(response=500, description="Unable to process delete request"),
     *      security={{"api_key":{}}}
     *     )
     *
     * Delete a  Vehicle
     */
    public function destroy($id)
    {
        try {
            return $this->vehicleRepository->destroy($id);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Unable to process delete request'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
