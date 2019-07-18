<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema()
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     *
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   description="The user name"
     * )
     * 
     * @OA\Property(
     *   property="email",
     *   type="string",
     *   description="The user email"
     * )
     * 
     * @OA\Property(
     *   property="password",
     *   type="string",
     *   description="The user password"
     * )
     * 
     * @OA\Property(
     *   property="role_id",
     *   type="int",
     *   description="The user role id"
     * )
     * 
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the vehicles for the user.
     */
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
