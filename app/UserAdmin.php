<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use App\UserAdmin;
use App\ItemPaket;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class UserAdmin extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

     /**
       * Table database
       */
      protected $table = 'users_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'api_key'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_key'
    ];
}
