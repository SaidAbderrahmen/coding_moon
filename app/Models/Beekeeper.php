<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;


use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Beekeeper extends  Authenticatable implements JWTSubject
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'password',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password'];

    public function hives()
    {
        return $this->hasMany(Hive::class);
    }

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
