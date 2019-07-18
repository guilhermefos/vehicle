<?php

namespace App\Repositories\Api;

use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VehicleRepository
{
  public function index()
  {
    $vehicles = Auth::user()->vehicles()->get();

    return count($vehicles) <= 0 ?
      response()->json(['message' => 'empty vehicles list'], Response::HTTP_OK) :
      response()->json($vehicles, Response::HTTP_OK);
  }

  public function store($data)
  {
    $vehicle = Vehicle::create([
        'year'    => Carbon::parse($data['year']),
        'color'   => $data['color'],
        'brand'   => $data['brand'],
        'model'   => $data['model'],
        'plate'   => $data['plate'],
        'chassis' => $data['chassis'],
        'renavam' => $data['renavam'],
        'user_id' => Auth::user()->id
      ]);

      return response()->json($vehicle, Response::HTTP_CREATED);
  }

  public function update($data)
  {
    $vehicle = Vehicle::where('chassis', $data['chassis'])->update([
      'year'    => Carbon::parse($data['year']),
      'color'   => $data['color'],
      'brand'   => $data['brand'],
      'model'   => $data['model'],
      'plate'   => $data['plate'],
      'chassis' => $data['chassis'],
      'renavam' => $data['renavam'],
    ]);

    return response()->json(['message' => 'vehicle updated'], Response::HTTP_OK);
  }

  public function destroy($id)
  {
    $vehicle = Vehicle::find($id);
    $vehicle->delete();

    return response()->json([
      'message' => 'vehicle deleted',
      'vehicle' => $vehicle
    ], Response::HTTP_OK);
  }

}