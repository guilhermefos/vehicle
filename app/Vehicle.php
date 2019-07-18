<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema()
 */
class Vehicle extends Model
{
    use SoftDeletes;

    /**
     *
     * @OA\Property(
     *   property="user_id",
     *   type="int",
     *   description="The vehicle user id"
     * )
     * 
     * @OA\Property(
     *   property="brand",
     *   type="string",
     *   description="The vehicle brand"
     * )
     * 
     * @OA\Property(
     *   property="chassis",
     *   type="string",
     *   description="The vehicle chassis"
     * )
     * 
     * @OA\Property(
     *   property="color",
     *   type="string",
     *   description="The vehicle color"
     * )
     * 
     * @OA\Property(
     *   property="model",
     *   type="string",
     *   description="The vehicle model"
     * )
     * 
     * @OA\Property(
     *   property="year",
     *   type="string",
     *   description="The vehicle year"
     * )
     * 
     * @OA\Property(
     *   property="plate",
     *   type="string",
     *   description="The vehicle plate"
     * )
     * 
     * @OA\Property(
     *   property="renavam",
     *   type="string",
     *   description="The vehicle renavam"
     * )
     * 
     */
    protected $fillable = [
        'user_id', 'brand', 'chassis', 'color', 'model', 'year', 'plate', 'renavam'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'year', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
